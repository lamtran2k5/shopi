<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show checkout page
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $subtotal = $this->calculateSubtotal($cart);
        $shippingFee = 30000; // Fixed shipping fee
        $total = $subtotal + $shippingFee;

        return view('orders.checkout', compact('cart', 'subtotal', 'shippingFee', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:COD,bank_transfer,momo,vnpay',
            'note' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []); // [product_id => quantity]

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();

        try {
            // 1. Lấy thông tin sản phẩm từ DB
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            // 2. Tính subtotal
            $subtotal = 0;
            foreach ($cart as $productId => $quantity) {
                if (!isset($products[$productId])) {
                    continue; // skip nếu sản phẩm không tồn tại
                }
                $product = $products[$productId];
                $price = $product->sale_price ?? $product->price;
                $subtotal += $price * $quantity;
            }

            $shippingFee = 30000;
            $total = $subtotal + $shippingFee;

            // 3. Tạo order
            $order = Order::create([
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'total_amount' => $total,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
            ]);

            // 4. Tạo order items và cập nhật stock
            foreach ($cart as $productId => $quantity) {
                if (!isset($products[$productId])) continue;

                $product = $products[$productId];
                $price = $product->sale_price ?? $product->price;

                // Kiểm tra tồn kho
                if ($product->stock < $quantity) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ hàng trong kho!");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $product->name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total' => $price * $quantity,
                ]);

                // Trừ stock
                $product->stock -= $quantity;
                $product->save();
            }

            // 5. Xóa cart session
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    // Show order detail
    public function show(Order $order)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user && $user->id !== $order->user_id && !$user->isAdmin()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }

    // Show user's orders
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.my-orders', compact('orders'));
    }

    // Calculate subtotal
    public function calculateSubtotal(array $cart)
    {
        // Lấy tất cả sản phẩm trong cart từ database
        $productIds = array_keys($cart); 
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id'); 

        $subtotal = 0; 
        foreach ($cart as $productId => $quantity) {
            if (!isset($products[$productId])) {
                continue;
            }

            $product = $products[$productId];

            if ($product->sale_price !== null) {
                $finalPrice = $product->sale_price;
            } else {
                $finalPrice = $product->price;
            }

            $subtotal += $finalPrice * $quantity;
        }

        return $subtotal; 
    }

}
