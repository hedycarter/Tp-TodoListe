CREATE TABLE IF NOT EXISTS todo(
	id_todo INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(25),
    statut BOOLEAN DEFAULT(FALSE)
);