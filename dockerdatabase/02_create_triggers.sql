CREATE OR REPLACE FUNCTION check_dealer_fk()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.dealer_type_id = 1 THEN
        IF NOT EXISTS (SELECT * FROM app_user WHERE id = NEW.dealer_entity_id) THEN
            RAISE EXCEPTION 'Invalid user id for dealer';
        END IF;
    ELSIF NEW.dealer_type_id = 2 THEN
        IF NOT EXISTS (SELECT * FROM venue WHERE id = NEW.dealer_entity_id) THEN
            RAISE EXCEPTION 'Invalid venue id for dealer';
        END IF;
    ELSE 
        RAISE EXCEPTION 'Invalid dealer type';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER before_insert_dealer
BEFORE INSERT OR UPDATE ON dealer
FOR EACH ROW EXECUTE FUNCTION check_dealer_fK(); 

CREATE OR REPLACE FUNCTION log_update_on_table()
RETURNS TRIGGER AS $$ 
    BEGIN
        NEW.updated_at := current_timestamp;
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER before_update_persona 
BEFORE UPDATE ON persona
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_artist
BEFORE UPDATE ON artist
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_painting
BEFORE UPDATE ON painting
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_painting_frames
BEFORE UPDATE ON painting_frames
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_venue
BEFORE UPDATE ON venue
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_app_user
BEFORE UPDATE ON app_user
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_dealer
BEFORE UPDATE ON dealer
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_sale
BEFORE UPDATE ON sale
FOR EACH ROW
EXECUTE FUNCTION log_update_on_table();

CREATE OR REPLACE TRIGGER before_update_cart
BEFORE UPDATE ON cart
FOR EACH ROW 
EXECUTE FUNCTION log_update_on_table();



