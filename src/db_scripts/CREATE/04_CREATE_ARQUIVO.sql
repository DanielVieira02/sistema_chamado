DROP TABLE IF EXISTS ARQUIVO;

CREATE TABLE IF NOT EXISTS ARQUIVO(
	Id INT AUTO_INCREMENT NOT NULL,
    ChamadoId INT NOT NULL,
    Nome INT NOT NULL,
    Path VARCHAR(200),
	PRIMARY KEY (Id),
	FOREIGN KEY (ChamadoId)
		REFERENCES Chamado (Id)
);