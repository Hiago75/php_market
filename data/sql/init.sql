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

INSERT INTO product_types (id, name) VALUES
  ('1', 'Eletrônicos'),
  ('2', 'Roupas'),
  ('3', 'Alimentos');

INSERT INTO products (id, name, type_id, price) VALUES
  ('1', 'Smartphone', '1', 1500.00),
  ('2', 'Notebook', '1', 3000.00),
  ('3', 'Camiseta', '2', 50.00),
  ('4', 'Calça', '2', 80.00),
  ('5', 'Arroz', '3', 5.00);

INSERT INTO taxes (id, type_id, percentage) VALUES
  ('1', '1', 10.00),
  ('2', '2', 5.00),
  ('3', '3', 0.00);

INSERT INTO sales (id, subtotal, taxes, total, sale_date) VALUES
  ('1', 2000.00, 200.00, 2200.00, '2022-01-01'),
  ('2', 130.00, 6.50, 136.50, '2022-02-15'),
  ('3', 150.00, 0.00, 150.00, '2022-03-10'),
  ('4', 250.00, 12.50, 262.50, '2022-04-05'),
  ('5', 100.00, 5.00, 105.00, '2022-05-20');

INSERT INTO sale_items (id, sale_id, product_id, quantity) VALUES
  ('1', '1', '1', 2),
  ('2', '1', '3', 4),
  ('3', '2', '5', 10),
  ('4', '3', '2', 1),
  ('5', '4', '4', 3),
  ('6', '5', '1', 1);