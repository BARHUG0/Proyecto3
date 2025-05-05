--Testing polymorphic association validation trigger

-- Insert for dealer type app_user
-- The following should fail because the entity app_user does not contain pk 1000000
INSERT INTO dealer (dealer_type_id, dealer_entity_id) VALUES (1, 1000000);

-- Insert for dealer type venue
-- The following should fail because the entity venue does not contain pk 1000000
INSERT INTO dealer (dealer_type_id, dealer_entity_id) VALUES (2, 1000000);

-- Insert for invalid dealer type should fail, entity dealer_type does not contain pk 1000000
INSERT INTO dealer (dealer_type_id, dealer_entity_id) VALUES (1000000, 1);







--Testing the update trigger

-- For table persona
SELECT * FROM persona WHERE id = 1;

UPDATE persona
SET (first_given_name, second_given_name, third_given_name) = ('Hugh', 'Andrea', 'Yan')
WHERE id = 1;

SELECT * FROM persona WHERE id = 1;

-- For table artsit
SELECT * FROM artist WHERE id = 1;

UPDATE artist
SET pseudonym = 'Cool'
WHERE id = 1;

SELECT * FROM artist WHERE id = 1;

-- For table painting
SELECT * FROM painting WHERE id = 1;

UPDATE painting
SET (width, height, depth, title) = (51.00, 71.00, 3.00, 'Coolest Sunset Over the City')
WHERE id = 1;

SELECT * FROM painting WHERE id = 1;

-- For table painting_frames
SELECT * FROM painting_frames WHERE id = 1;

UPDATE painting_frames 
SET (width, height, depth, full_condition_report) = (20.00, 30.00, 3.00, 'Subtle color degradation')
WHERE id = 1;

SELECT * FROM painting_frames WHERE id = 1;

-- For table venue
SELECT * FROM venue WHERE id = 1;

UPDATE venue 
SET name = 'Cool Thai Red Curry Paste'
WHERE id = 1;

SELECT * FROM venue WHERE id = 1;

-- For table app_user
SELECT * FROM app_user WHERE id = 1;

UPDATE app_user
SET (persona_id, residence_address, email_address, phone_number)
= (6, 'Cool Address', 'me@gmailcom', '12345679101')
WHERE id = 1;

SELECT * FROM app_user WHERE id = 1;

-- For table dealer_type
SELECT * FROM dealer WHERE id = 1;

UPDATE dealer
SET created_at = current_timestamp
WHERE id = 1;

SELECT * FROM dealer WHERE id = 1;


