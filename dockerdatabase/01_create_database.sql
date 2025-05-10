CREATE TABLE country(
    id SERIAL PRIMARY KEY,
    name VARCHAR(32) UNIQUE NOT NULL
);

CREATE TABLE persona (
    id SERIAL PRIMARY KEY,
    nationality INTEGER REFERENCES country(id) ON DELETE RESTRICT NOT NULL,
    first_given_name VARCHAR(35) NOT NULL,
    second_given_name VARCHAR(32),
    third_given_name VARCHAR(32),
    paternal_last_name VARCHAR(32) NOT NULL,
    maternal_last_name VARCHAR(32),
    birthdate DATE NOT NULL,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP
);

CREATE TABLE artist (
    id SERIAL PRIMARY KEY,
    persona_id INTEGER REFERENCES persona(id) ON DELETE RESTRICT NOT NULL,
    pseudonym VARCHAR(32),
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP
);

CREATE TABLE signature_location (
    id SERIAL PRIMARY KEY,
    name VARCHAR(13) UNIQUE NOT NULL
);

CREATE TABLE painting (
    id SERIAL PRIMARY KEY,
    artist_id INTEGER REFERENCES artist(id) ON DELETE RESTRICT NOT NULL,
    signature_location_id INTEGER REFERENCES signature_location(id) ON DELETE RESTRICT,
    width DECIMAL(10, 2)  CHECK(width > 0) NOT NULL,
    height DECIMAL(10, 2) CHECK(height > 0) NOT NULL,
    depth DECIMAL(10, 2) CHECK(depth > 0),
    title VARCHAR(128) NOT NULL,
    execution_date DATE NOT NULL,
    description TEXT NOT NULL,
    includes_authenticity_certificate BOOLEAN NOT NULL,
    full_condition_report TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP
);

CREATE TABLE condition_notes (
    id SERIAL PRIMARY KEY,
    note VARCHAR(64) UNIQUE NOT NULL
);

CREATE TABLE painting_condition_summary (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    condition_note_id INTEGER REFERENCES condition_notes(id) ON DELETE RESTRICT NOT NULL,
    UNIQUE(painting_id, condition_note_id)
);

CREATE TABLE movement_style (
    id SERIAL PRIMARY KEY,
    name VARCHAR(128) UNIQUE NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE painting_movements_styles (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    movement_style_id INTEGER REFERENCES movement_style(id) ON DELETE RESTRICT NOT NULL,
    UNIQUE(painting_id, movement_style_id)
);

CREATE TABLE art_period (
    id SERIAL PRIMARY KEY,
    name VARCHAR(128) UNIQUE NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE painting_art_periods (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    art_period_id INTEGER REFERENCES art_period(id) ON DELETE RESTRICT NOT NULL,
    UNIQUE(painting_id, art_period_id)
);

CREATE TABLE material (
    id SERIAL PRIMARY KEY,
    name VARCHAR(128) UNIQUE NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE painting_materials (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    material_id INTEGER REFERENCES material(id) ON DELETE RESTRICT NOT NULL,
    UNIQUE(painting_id, material_id)
);

CREATE TABLE surface (
    id SERIAL PRIMARY KEY,
    name VARCHAR(128) UNIQUE NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE painting_surfaces (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    surface_id INTEGER REFERENCES surface(id) ON DELETE RESTRICT NOT NULL,
    UNIQUE(painting_id, surface_id)
);

CREATE TABLE transfer_type(
    id SERIAL PRIMARY KEY,
    name VARCHAR(32) UNIQUE NOT NULL
);

CREATE TABLE painting_provenance (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    transfer_type_id INTEGER REFERENCES transfer_type(id) ON DELETE RESTRICT NOT NULL,
    transfer_owner VARCHAR(255) NOT NULL,
    transfer_date DATE DEFAULT CURRENT_DATE,
    description TEXT
);

CREATE TABLE painting_literature (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    publisher_country INTEGER REFERENCES country(id) ON DELETE RESTRICT,
    author VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    publication_date DATE NOT NULL,
    publisher VARCHAR(255),
    page_number INTEGER CHECK(page_number > 0),
    illustration_details VARCHAR(255)
);

CREATE TABLE painting_frames (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT,
    width DECIMAL(10, 2) CHECK(width > 0) NOT NULL,
    height DECIMAL(10, 2) CHECK(height > 0) NOT NULL,
    depth DECIMAL(10, 2) CHECK(depth > 0),
    full_condition_report TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP
);

CREATE TABLE venue_type (
    id SERIAL PRIMARY KEY,
    type VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE venue (
    id SERIAL PRIMARY KEY,
    venue_type_id INTEGER REFERENCES venue_type(id) ON DELETE RESTRICT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    website_url TEXT,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP
);

CREATE TABLE venue_location (
    id SERIAL PRIMARY KEY,
    venue_id INTEGER REFERENCES venue(id) ON DELETE RESTRICT NOT NULL,
    country INTEGER REFERENCES country(id) ON DELETE RESTRICT NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(15)
);

CREATE TABLE venue_location_owned_paintings (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    venue_location_id INTEGER REFERENCES venue_location(id) ON DELETE RESTRICT NOT NULL,
    beginning_of_ownership DATE NOT NULL,
    ending_of_ownership DATE,
    CHECK(ending_of_ownership IS NULL OR ending_of_ownership >= beginning_of_ownership)
);

CREATE TABLE painting_exhibitions (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    venue_location_id INTEGER REFERENCES venue_location(id) ON DELETE RESTRICT NOT NULL,
    exhibition_beginning DATE NOT NULL,
    exhibition_ending DATE,
    exhibition_catalogue_number INTEGER,
    CHECK(exhibition_ending IS NULL OR exhibition_ending >= exhibition_beginning)
);

CREATE TABLE app_user (
    id SERIAL PRIMARY KEY,
    persona_id INTEGER REFERENCES persona(id) ON DELETE RESTRICT NOT NULL,
    residence_country INTEGER REFERENCES country(id) ON DELETE RESTRICT NOT NULL,
    residence_address TEXT NOT NULL,
    government_issued_id VARCHAR(64) NOT NULL,
    email_address VARCHAR(255) UNIQUE NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP
);


CREATE TABLE dealer_type(
    id SERIAL PRIMARY KEY,
    name VARCHAR(16) UNIQUE NOT NULL
);

CREATE TABLE dealer (
    id SERIAL PRIMARY KEY,
    dealer_type_id INTEGER REFERENCES dealer_type(id) ON DELETE RESTRICT NOT NULL,
    dealer_entity_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP,
    UNIQUE(dealer_type_id, dealer_entity_id)
);

CREATE TABLE dealer_shipping_addresses (
    id SERIAL PRIMARY KEY,
    dealer_id INTEGER REFERENCES dealer(id) ON DELETE RESTRICT NOT NULL,
    address TEXT NOT NULL
);

CREATE TABLE dealer_billing_addresses (
    id SERIAL PRIMARY KEY,
    dealer_id INTEGER REFERENCES dealer(id) ON DELETE RESTRICT NOT NULL,
    address TEXT NOT NULL
);


CREATE TABLE sale (
    id SERIAL PRIMARY KEY,
    painting_id INTEGER REFERENCES painting(id) ON DELETE RESTRICT NOT NULL,
    seller_id INTEGER REFERENCES dealer(id) ON DELETE RESTRICT NOT NULL,
    beginning_date DATE NOT NULL,
    ending_date DATE,
    sold_date DATE,
    lowest_estimated_price DECIMAL(10, 2) CHECK(lowest_estimated_price > 0) NOT NULL,
    highest_estimated_price DECIMAL(10, 2) CHECK(highest_estimated_price > 0) NOT NULL,
    base_price DECIMAL (10, 2) CHECK (base_price > 0),
    sold_price DECIMAL(10, 2) CHECK(sold_price > 0),
    is_available BOOLEAN,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP,
    CHECK(ending_date IS NULL OR ending_date >= beginning_date),
    CHECK(sold_price IS NULL AND sold_date IS NULL OR sold_price IS NOT NULL AND sold_date IS NOT NULL)
);

CREATE TABLE payment_status(
    id SERIAL PRIMARY KEY,
    name VARCHAR(16) UNIQUE NOT NULL
);

CREATE TABLE cart(
    id SERIAL PRIMARY KEY,
    buyer_id INTEGER REFERENCES dealer(id) ON DELETE CASCADE NOT NULL,
    buyer_shipping_address_id INTEGER REFERENCES dealer_shipping_addresses(id) ON DELETE SET NULL,
    buyer_billing_address_id INTEGER REFERENCES dealer_billing_addresses(id) ON DELETE SET NULL,
    payment_status_id INTEGER REFERENCES payment_status(id) ON DELETE RESTRICT, 
    subtotal DECIMAL (10, 2) CHECK(subtotal > 0),
    tax_rate DECIMAL (3, 2) CHECK(tax_rate > 0 AND tax_rate <= 1),
    shipping_fee DECIMAL(10, 2) CHECK(shipping_fee > 0),
    total DECIMAL (10, 2) CHECK(total > 0),
    payment_method VARCHAR(16),
    paid_at DATE,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP,
    CHECK (total >= subtotal)
);

CREATE TABLE cart_items (
    id SERIAL PRIMARY KEY,
    cart_id INTEGER REFERENCES cart(id) ON DELETE CASCADE NOT NULL,
    sale_id INTEGER REFERENCES sale(id) ON DELETE CASCADE NOT NULL
);
