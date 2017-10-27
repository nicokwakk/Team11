#CREATE DEFINER=`17ac3u11`@`silva.computing.dundee.ac.uk`
DELIMITER //
DROP PROCEDURE IF EXISTS 17ac3d11.`CreateProduct` //

CREATE PROCEDURE 17ac3d11.`CreateProduct` (IN PName varchar(255),
IN PBrand varchar(255),
IN PPrice int(5),
IN PType varchar(255),
IN PSalesP varchar(3),
IN PImgP varchar(255),
IN PDesc varchar(1000),
OUT pID INT(10))
BEGIN
	INSERT INTO 17ac3d11.products (ProductName,Brand,Price,TypeOfProduct,Price,SalesPercentage,ImagePath,ProductDesc)
    values
    (PName,PBrand,PType,PSalesP,PImgP,PDesc);
	SET pID = LAST_INSERT_ID();
END //
DELIMITER ;
