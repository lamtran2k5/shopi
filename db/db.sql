CREATE DATABASE IF NOT EXISTS shoppi;

USE shoppi;

CREATE TABLE users (
  id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name     VARCHAR(120) NOT NULL,
  username      VARCHAR(50)  NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  gmail         VARCHAR(255) NOT NULL UNIQUE,
  address       VARCHAR(255),
  sex           ENUM('male','female','other') NOT NULL,
  date_of_birth DATE NOT NULL,
  role          ENUM('customer','seller','admin') NOT NULL DEFAULT 'customer'
);

INSERT INTO users (full_name, username, password_hash, gmail, address, sex, date_of_birth, role) VALUES
('Nguyen Van A', 'nguyenvana', 'e10adc3949ba59abbe56e057f20f883e', 'nguyenvana@gmail.com', '123 Đường ABC, Hà Nội', 'male', '2000-05-15', 'customer'),
('Tran Thi B',   'tranthib',   'e80b5017098950fc58aad83c8c14978e', 'tranthib@gmail.com',   '45 Nguyễn Huệ, TP.HCM', 'female', '1999-10-20', 'customer'),
('Le Van C',     'levanc',     'd8578edf8458ce06fbc5bb76a58c5ca4', 'levanc@gmail.com',     '78 Lê Lợi, Đà Nẵng',   'male',   '2001-03-12', 'seller'),
('Pham Thi D',   'phamthid',   'fa246d0262c3925617b0c72bb20eeb1d', 'phamthid@gmail.com',   '56 Trần Hưng Đạo, Huế','female', '2002-07-25', 'customer'),
('Hoang Van E',  'hoangvane',  '5f4dcc3b5aa765d61d8327deb882cf99', 'hoangvane@gmail.com', '90 Lý Thường Kiệt, Cần Thơ','male','1998-12-05','admin');