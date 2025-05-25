
-- SQLINES DEMO ***  `gestion_stock2`
--
-- SQLINES DEMO *** ---------------------------------------
--
-- SQLINES DEMO *** able `categories`
--
-- SQLINES FOR EVALUATION USE ONLY (14 DAYS)
CREATE TABLE categories (
  id bigint CHECK (id > 0) NOT NULL,
  name varchar(150) DEFAULT NULL,
  description text DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;
--
-- SQLINES DEMO *** données de la table `categories`
--
INSERT INTO categories (id, name, description, created_at, updated_at) VALUES
(1, 'Réfrigérateurs', 'Appareils de conservation au froid', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(2, 'Micro-ondes', 'Fours micro-ondes', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(3, 'Lave-vaisselle', 'Machines pour laver la vaisselle', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(4, 'Climatiseurs', 'Appareils de climatisation', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(4, 'Téléviseurs', 'Appareils de télévision', '2025-04-25 17:29:40', '2025-04-25 175:29:40'),
(6, 'Ordinateurs', 'Ordinateurs portables et de bureau', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(7, 'Smartphones', 'Téléphones intelligents', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(8, 'Tablettes', 'Appareils tablettes', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(9, 'Accessoires électroniques', 'Câbles, chargeurs, etc.', '2025-04-25 17:29:40', '2025-04-25 17:29:40');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `customers`
--

CREATE TABLE customers (
  id bigint(20) UNSIGNED NOT NULL,
  name varchar(150) DEFAULT NULL,
  email varchar(150) DEFAULT NULL,
  phone varchar(50) DEFAULT NULL,
  address text DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 /* COLLATE= */utf8mb4_general_ci;

--
-- SQLINES DEMO *** données de la table `customers`
--

INSERT INTO customers (id, name, email, phone, address, created_at, updated_at) VALUES
(1, 'Jean Dupont', 'jean.dupont@example.com', '0601020304', '123 Rue Lafayette, Paris', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(2, 'Marie Claire', 'marie.claire@example.com', '0605060708', '456 Avenue de la République, Lyon', '2025-04-25 17:29:40', '2025-04-25 17:29:40');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `orders`
--

CREATE TABLE orders (
  id bigint CHECK (id > 0) NOT NULL,
  customer_id bigint CHECK (customer_id > 0) DEFAULT NULL,
  order_date date DEFAULT NULL,
  status varchar(30) check (status in ('en_attente','en_cours','livrée','annulée')) DEFAULT 'en_attente',
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** données de la table `orders`
--

INSERT INTO orders (id, customer_id, order_date, status, created_at, updated_at) VALUES
(1, 1, '2025-04-25', 'en_cours', '2025-04-25 17:29:40', '2025-04-25 17:29:40'),
(2, 2, '2025-04-25', 'en_attente', '2025-04-25 17:29:40', '2025-04-25 17:29:40');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `order_items`
--

CREATE TABLE order_items (
  id bigint CHECK (id > 0) NOT NULL,
  order_id bigint CHECK (order_id > 0) DEFAULT NULL,
  product_id bigint CHECK (product_id > 0) DEFAULT NULL,
  quantity int DEFAULT NULL,
  price decimal(10,2) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `products`
--

CREATE TABLE products (
  id bigint CHECK (id > 0) NOT NULL,
  category_id bigint CHECK (category_id > 0) DEFAULT NULL,
  name varchar(150) DEFAULT NULL,
  description text DEFAULT NULL,
  price decimal(10,2) DEFAULT NULL,
  quantity int DEFAULT 0,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL,
  image bytea DEFAULT NULL
) ;

--
-- SQLINES DEMO *** données de la table `products`
--

INSERT INTO products (id, category_id, name, description, price, quantity, created_at, updated_at, image) VALUES
(11, NULL, 'Iphone 14', '128Go, 25 pixel', 5000.00, 4, '2025-05-09 23:27:36', '2025-05-09 23:27:36', 0x52526a41305032315a6371504a38794b7a4b7750683732354658417a3349556f79794951455341392e6a7067),
(12, NULL, 'Oppo', 'OPPO Reno 8 Pro 5G, Dual 256GB, 12GB RAM, Factory Unlocked GSM - Green', 7000.00, 7, '2025-05-09 23:36:23', '2025-05-09 23:36:23', 0x7365535a7a394e473255434b6d745343645936686c656e6b67514479737979424341556d4c7774462e6a7067),
(13, NULL, 'Réfrigérateur LG 350L', 'Réfrigérateur classe énergétique A++.', 6800.00, 10, '2025-05-10 21:57:42', '2025-05-10 22:59:55', 0x58516f71745a5533774a6f713078464c674e49506837674a7265367a386130504845397179546a322e6a7067),
(14, NULL, 'Lave-linge Bosch 8kg', 'Machine à laver Bosch à chargement frontal', 4500.00, 13, '2025-05-10 21:58:52', '2025-05-10 23:00:25', 0x704e474f494b39486134514b69675068734d777a796c5a423665553047364263666f36726d5a37562e6a7067),
(15, NULL, 'Lave-linge Samsung 9kg', 'Machine intelligente Samsung.', 6000.00, 10, '2025-05-10 22:01:00', '2025-05-10 22:01:00', 0x4f544e49614a704a44774a4c7444644c6e4359643153445064447959776f7a55396d46536b4644362e706e67),
(16, NULL, 'Micro-ondes Whirlpool', 'Four micro-ondes 25L.', 700.00, 14, '2025-05-10 22:57:26', '2025-05-10 22:57:26', 0x6b5a5643485959527a4c5736584e547661306d6642324b4d4c6546686e63644262413363564c4c622e6a7067),
(17, NULL, 'Lave-vaisselle Siemens', 'Lave-vaisselle avec 12 couverts.', 9000.00, 10, '2025-05-10 22:59:01', '2025-05-10 22:59:25', 0x47764b537a506d38634c7558756f3959426e53414c75696b33684b7a3949596b39574151506278792e6a7067);

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `stock_arrivals`
--

CREATE TABLE stock_arrivals (
  id bigint CHECK (id > 0) NOT NULL,
  supplier_id bigint CHECK (supplier_id > 0) DEFAULT NULL,
  product_id bigint CHECK (product_id > 0) DEFAULT NULL,
  quantity int DEFAULT NULL,
  arrival_date date DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** données de la table `stock_arrivals`
--

INSERT INTO stock_arrivals (id, supplier_id, product_id, quantity, arrival_date, created_at, updated_at) VALUES
(5, 1, 11, 9, '2025-05-11', '2025-05-10 23:30:27', '2025-05-10 23:30:27');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `suppliers`
--

CREATE TABLE suppliers (
  id bigint CHECK (id > 0) NOT NULL,
  name varchar(150) DEFAULT NULL,
  contact_info text DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL,
  phone varchar(100) DEFAULT NULL
) ;

--
-- SQLINES DEMO *** données de la table `suppliers`
--

INSERT INTO suppliers (id, name, contact_info, created_at, updated_at, phone) VALUES
(1, 'Fournisseur ElectroPlus', 'electroplus@example.com', '2025-04-25 17:29:40', '2025-04-29 19:38:50', '0635485822'),
(2, 'Fournisseur HomeTech', 'hometech@example.com', '2025-04-25 17:29:40', '2025-04-25 17:29:40', '0636357276'),
(3, 'Fournisseur CoolMaster', 'coolmaster@example.com', '2025-04-25 17:29:40', '2025-04-25 17:29:40', '0643526789');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** able `users`
--

CREATE TABLE users (
  id bigint CHECK (id > 0) NOT NULL,
  name varchar(100) DEFAULT NULL,
  email varchar(150) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  role varchar(30) check (role in ('admin','super_admin')) DEFAULT 'admin',
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL,
  remember_token varchar(100) DEFAULT NULL
) ;

--
-- SQLINES DEMO *** données de la table `users`
--

INSERT INTO users (id, name, email, password, role, created_at, updated_at, remember_token) VALUES
(2, 'Nidal', 'nidal27@gmail.com', '$2y$12$.mt5mqiq70O6jmAV8u8pqutZAt.WbbZgXzMQoHBZ0ZnoEDFbU40jG', 'super_admin', '2025-04-25 19:53:32', '2025-04-25 19:53:32', NULL);

--
-- SQLINES DEMO *** bles déchargées
--

--
-- SQLINES DEMO *** le `categories`
--
ALTER TABLE categories
  ADD PRIMARY KEY (id);

--
-- SQLINES DEMO *** le `customers`
--
ALTER TABLE customers
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email);

--
-- SQLINES DEMO *** le `orders`
--
ALTER TABLE orders
  ADD PRIMARY KEY (id),
  ADD KEY customer_id (customer_id);

--
-- SQLINES DEMO *** le `order_items`
--
ALTER TABLE order_items
  ADD PRIMARY KEY (id),
  ADD KEY order_id (order_id),
  ADD KEY product_id (product_id),
  ADD KEY idx_order_product (order_id,product_id);

--
-- SQLINES DEMO *** le `products`
--
ALTER TABLE products
  ADD PRIMARY KEY (id),
  ADD KEY fk_products_category (category_id);

--
-- SQLINES DEMO *** le `stock_arrivals`
--
ALTER TABLE stock_arrivals
  ADD PRIMARY KEY (id),
  ADD KEY supplier_id (supplier_id),
  ADD KEY product_id (product_id);

--
-- SQLINES DEMO *** le `suppliers`
--
ALTER TABLE suppliers
  ADD PRIMARY KEY (id);

--
-- SQLINES DEMO *** le `users`
--
ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email);

--
-- SQLINES DEMO *** ur les tables déchargées
--

--
-- SQLINES DEMO *** ur la table `categories`
--
ALTER TABLE categories
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8941;

--
-- SQLINES DEMO *** ur la table `customers`
--
ALTER TABLE customers
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- SQLINES DEMO *** ur la table `orders`
--
ALTER TABLE orders
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- SQLINES DEMO *** ur la table `order_items`
--
ALTER TABLE order_items
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- SQLINES DEMO *** ur la table `products`
--
ALTER TABLE products
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- SQLINES DEMO *** ur la table `stock_arrivals`
--
ALTER TABLE stock_arrivals
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- SQLINES DEMO *** ur la table `suppliers`
--
ALTER TABLE suppliers
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- SQLINES DEMO *** ur la table `users`
--
ALTER TABLE users
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- SQLINES DEMO *** les tables déchargées
--

--
-- SQLINES DEMO *** la table `orders`
--
ALTER TABLE orders
  ADD CONSTRAINT orders_ibfk_1 FOREIGN KEY (customer_id) REFERENCES customers (id);

--
-- SQLINES DEMO *** la table `order_items`
--
ALTER TABLE order_items
  ADD CONSTRAINT order_items_ibfk_1 FOREIGN KEY (order_id) REFERENCES orders (id),
  ADD CONSTRAINT order_items_ibfk_2 FOREIGN KEY (product_id) REFERENCES products (id);

--
-- SQLINES DEMO *** la table `products`
--
ALTER TABLE products
  ADD CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL;

--
-- SQLINES DEMO *** la table `stock_arrivals`
--
ALTER TABLE stock_arrivals
  ADD CONSTRAINT stock_arrivals_ibfk_1 FOREIGN KEY (supplier_id) REFERENCES suppliers (id),
  ADD CONSTRAINT stock_arrivals_ibfk_2 FOREIGN KEY (product_id) REFERENCES products (id);
COMMIT;
