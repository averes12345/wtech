DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'SEX_ENUM') THEN
    CREATE TYPE SEX_ENUM AS ENUM ('male', 'female', 'unisex');
  END IF;
END
$$;

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'PAYMENT_METHOD') THEN
    CREATE TYPE PAYMENT_METHOD AS ENUM ('google pay', 'apple pay', 'card');
  END IF;
END
$$;
/*
DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'SIZE_ENUM') THEN
    CREATE TYPE SIZE_ENUM AS ENUM ('XS', 'S', 'M', 'L', 'XL');
  END IF;
END
$$;
*/



CREATE TABLE countries
(
    code CHAR(2) PRIMARY KEY, -- ISO ALPHA-2 CODE
    name TEXT NOT NULL
);

CREATE TABLE shipping_details
(
    id SERIAL PRIMARY KEY,
    country_id CHAR(2) REFERENCES countries (code),
    street_address TEXT,
    city TEXT,
    region TEXT,
    zip_code TEXT
);

CREATE TABLE payment_details
(
  id SERIAL PRIMARY KEY,
  method PAYMENT_METHOD
);

CREATE TABLE card_details
(
  id SERIAL PRIMARY KEY,
  payment_details_id INTEGER REFERENCES payment_details,
  card_number VARCHAR(19), --card number lengths can differ
    expiration_date TIMESTAMPTZ,
    cvc CHAR(3)
);

CREATE TABLE users
(
    id         SERIAL PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name  TEXT NOT NULL,
    email      TEXT UNIQUE NOT NULL,
    phone      INTEGER DEFAULT NULL,
        password   TEXT        NOT NULL,
    saved_shipping_preference INTEGER REFERENCES shipping_details (id) DEFAULT NULL,
    saved_payment_preference INTEGER REFERENCES payment_details (id) DEFAULT NULL
);


CREATE TABLE categories(
    id SERIAL PRIMARY KEY,
    name TEXT UNIQUE
);

CREATE TABLE products
(
    id          SERIAL PRIMARY KEY,
    name        TEXT           NOT NULL,
    description TEXT,
    price       NUMERIC(10, 2) NOT NULL,
    brand       TEXT,
    sex         SEX_ENUM
);

CREATE TABLE product_categories --to model a many to many relationship
(
    id          SERIAL PRIMARY KEY,
    products_id INTEGER REFERENCES products(id),
    categories_id  INTEGER REFERENCES categories(id)
);

CREATE TABLE colors
(
    id         SERIAL PRIMARY KEY,
    color_name TEXT,
    color_code TEXT --used if we want to display something of the color on the website
);

CREATE TABLE sizes ( --because sizes can vary with different kinds of clothing (shirt: xs,pants: 48-52,shoes 43)
    id SERIAL PRIMARY KEY,
    size TEXT UNIQUE
);

CREATE TABLE product_color_size --to store the stock of products per color per size
(
    id          SERIAL PRIMARY KEY,
    products_id    INTEGER REFERENCES products (id),
    colors_id      INTEGER REFERENCES colors (id),
    sizes_id        INTEGER REFERENCES sizes (id),
    count_in_stock INTEGER DEFAULT 0,
    UNIQUE (products_id, colors_id, sizes_id)
);

CREATE TABLE product_images
(
    id         SERIAL PRIMARY KEY,
    product_color_size_id INTEGER REFERENCES product_color_size (id), --to be able to asociate an image with a particular color size / color
    image_path TEXT, --path to the image on the server
    alt        TEXT --alt description injected into site html
);

CREATE TABLE order_items --represents a particular item belonging to a particular order with its quantity (used to model many to many)
(
    id SERIAL PRIMARY KEY,
    orders_id INTEGER REFERENCES orders (id) NOT NULL,
    specific_product_id  INTEGER REFERENCES product_color_size (id) NOT NULL,
    quantity   INTEGER CHECK (quantity > 0) NOT NULL
);

CREATE TABLE orders --eighter a current cart if it is linked from the user otherwise to maintain the users shopping history
(
    user_id INTEGER REFERENCES users (id),
    shipping_details_id INTEGER REFERENCES shipping_details (id), --shipping detailes used during the purchase
    payment_detaild_id INTEGER REFERENCES payment_details (id), --payment details used during the purchase
    date_created TIMESTAMPTZ NOT NULL,
    data_ordered TIMESTAMPTZ
);

ALTER TABLE users
    ADD COLUMN cart_id INTEGER REFERENCES orders(id);

DROP TABLE IF EXISTS
        users,
    countries,
    shipping_details,
    shipping_addresses,
    products,
    colors,
    sizes,
    product_color_size,
    product_images,
    cart,
    orders
    CASCADE;
