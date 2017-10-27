#CREATE DEFINER=`17ac3u11`@`silva.computing.dundee.ac.uk`
DELIMITER //
DROP PROCEDURE IF EXISTS 17ac3d11.`CreateBranch` //

CREATE PROCEDURE 17ac3d11.`CreateBranch` (IN FLine varchar(255),
IN SLine varchar(255),
IN Pscode varchar(8),
IN Country varchar(255),
OUT bID INT(5))
BEGIN
	INSERT INTO 17ac3d11.addresses (FirstLineAddress,SecondLineAddress,PostCode,Country)
	values (FLine,SLine,Pscode,Country);
    
    INSERT INTO 17ac3d11.branches (AddressID)
    values (LAST_INSERT_ID());
	SET bID = LAST_INSERT_ID();
END //
DELIMITER ;
