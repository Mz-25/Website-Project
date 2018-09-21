INSERT INTO category (c_id,c_name,c_description) VALUES 
(NULL,'Υδραυλικό','Οποιαδήποτε προβλήματα αφορούν υδραυλικές ζημιές.'),
(NULL,'Ηλεκτρολογικό','Οποιαδήποτε προβλήματα αφορούν ηλεκτρολογικές ζημιές στο Δήμο μας.'),
(NULL,'Οδικό','Οποιαδήποτε προβλήματα αφορούν προβλήματα στις κτιριακές εγκαταστάσεις ή στο οδόστρωμα.'),
(NULL,'Άλλο','Οποιοδήποτε άλλο πρόβλημα χωρίς κατηγορία.');

INSERT INTO person (p_id,name,surname,username,password,email,phone_number,birthdate,authorization,gender) VALUES 
(NULL,'Μαρίνα','Ζαρνομήτρου','mz25','mouton90','marinaz@hotmail.com',6993768989,'1990-02-25','b','f'),
(NULL,'Γεωργία','Ζαρνομήτρου','geo02','bbdk92','gzarnomitrou@hotmail.com',6942098765,'1992-11-02','b','f');

INSERT INTO administrator (a_id,bio) VALUES
(1,'Πτύχιο στη λογιστική. Μιλάει 3 γλώσσες. Δουλεύει ως λογίστρια στην εταιρεία Logist'),
(2,'Πτυχίο στα οικονομικά. Μιλάει 2 γλώσσες. Δουλεύει σε εταιρεία ηλεκτρονικών');

