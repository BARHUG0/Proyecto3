-- Queries for reports

-- Report the title and the material used by the painting
SELECT p.title, m.name  FROM painting_materials AS pm
JOIN painting AS p ON p.id = pm.painting_id
JOIN material AS m ON m.id = pm.material_id
ORDER BY p.title, m.name;

-- Report all existing materials
SELECT name, description FROM material;

-- Report condition of all paintings
SELECT p.title, c.note, p.full_condition_report FROM painting_condition_summary AS pc
JOIN painting AS p ON p.id = pc.painting_id
JOIN condition_notes AS c ON c.id = pc.condition_note_id
ORDER BY p.title;

-- Report provenance
SELECT p.title, t.name, pp.transfer_owner, pp.transfer_date, pp.description  FROM painting_provenance AS pp
JOIN painting AS p ON p.id = pp.painting_id
JOIN transfer_type AS t ON t.id = pp.transfer_type_id;