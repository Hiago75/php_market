--Criar as base de dados
CREATE DATABASE market ENCODING 'UTF8' LC_COLLATE 'en_US.utf8' LC_CTYPE 'en_US.utf8' TEMPLATE template0;
\c market;

CREATE TABLE IF NOT EXISTS product_types (
  id VARCHAR(96) PRIMARY KEY,
  name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS products (
  id VARCHAR(96) PRIMARY KEY,
  name VARCHAR(255),
  type_id VARCHAR(96) REFERENCES product_types(id),
  price DECIMAL(10, 2)
);

CREATE TABLE IF NOT EXISTS taxes (
  id VARCHAR(96) PRIMARY KEY,
  type_id VARCHAR(96) REFERENCES product_types(id),
  percentage DECIMAL(5, 2)
);

CREATE TABLE IF NOT EXISTS sales (
  id VARCHAR(96) PRIMARY KEY,
  subtotal DECIMAL(10, 2),
  taxes DECIMAL(10, 2),
  total DECIMAL(10, 2),
  sale_date DATE
);

CREATE TABLE IF NOT EXISTS sale_items (
  id VARCHAR(96) PRIMARY KEY,
  sale_id VARCHAR(96) REFERENCES sales(id),
  product_id VARCHAR(96) REFERENCES products(id),
  quantity INT
);

--Popular a base

\c market;

INSERT INTO product_types (id, name)
VALUES
  ('1', 'Eletrônicos'),
  ('2', 'Roupas'),
  ('3', 'Alimentos');

INSERT INTO products (id, name, type_id, price)
VALUES
  ('1001', 'Smartphone', '1', 1200.00),
  ('1002', 'TV LED', '1', 1500.00),
  ('2001', 'Camiseta', '2', 29.90),
  ('2002', 'Calça Jeans', '2', 79.90),
  ('3001', 'Arroz', '3', 5.50),
  ('3002', 'Feijão', '3', 4.80);

INSERT INTO taxes (id, type_id, percentage)
VALUES
  ('TAX1', '1', 18.00),
  ('TAX2', '2', 12.00),
  ('TAX3', '3', 7.00);

INSERT INTO sales (id, product_id, quantity, sale_date)
VALUES
  ('SALE1', '1001', 2, '2023-06-15'),
  ('SALE2', '2002', 1, '2023-06-14'),
  ('SALE3', '3001', 5, '2023-06-13');
