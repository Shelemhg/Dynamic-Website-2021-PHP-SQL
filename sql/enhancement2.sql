INSERT INTO clients
	(clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES
	('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');


UPDATE 
	clients
SET	
	clientLevel = 3
WHERE
	clientFirstname = 'Tony';



UPDATE 
	inventory
SET	invDescription = REPLACE(invDescription, 'small', 'spacious')
WHERE
	invMake = 'GM';



SELECT * FROM 
	inventory 
INNER JOIN 
	carclassification ON inventory.classificationId = carclassification.classificationId
WHERE 
	inventory.classificationId = 1;



DELETE FROM	
	inventory
WHERE
	invModel = 'Wrangler';



UPDATE 
	inventory
SET	invImage = CONCAT('/phpmotors', invImage);



UPDATE 
	inventory
SET	invThumbnail = CONCAT('/phpmotors', invThumbnail);
