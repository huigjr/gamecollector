INSERT INTO games2 (`title`, `url`, `description_nl`, `description_en`) 
SELECT title,url,description_nl,description_en FROM games ORDER BY url

INSERT INTO games SELECT * FROM games2