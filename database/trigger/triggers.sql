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

