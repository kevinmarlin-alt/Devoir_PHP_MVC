USE klaxon;

INSERT INTO agencies (city) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

INSERT INTO employees (lastname, firstname, phone, email, passeword) VALUES
('Martin','Alexandre','0612345678','alexandre.martin@email.fr', $2y$12$rb2UafrObXyi72uAaQAH9O9Ivke6KIKM.0yoZF2RhHTSzG9k6PUt6),
('Dubois','Sophie','0698765432','sophie.dubois@email.fr', NULL),
('Bernard','Julien','0622446688','julien.bernard@email.fr', NULL),
('Moreau','Camille','0611223344','camille.moreau@email.fr', NULL),
('Lefèvre','Lucie','0777889900','lucie.lefevre@email.fr', NULL),
('Leroy','Thomas','0655443322','thomas.leroy@email.fr', NULL),
('Roux','Chloé','0633221199','chloe.roux@email.fr', NULL),
('Petit','Maxime','0766778899','maxime.petit@email.fr', NULL),
('Garnier','Laura','0688776655','laura.garnier@email.fr', NULL),
('Dupuis','Antoine','0744556677','antoine.dupuis@email.fr', NULL),
('Lefebvre','Emma','0699887766','emma.lefebvre@email.fr', NULL),
('Fontaine','Louis','0655667788','louis.fontaine@email.fr', NULL),
('Chevalier','Clara','0788990011','clara.chevalier@email.fr', NULL),
('Robin','Nicolas','0644332211','nicolas.robin@email.fr', NULL),
('Gauthier','Marine','0677889922','marine.gauthier@email.fr', NULL),
('Fournier','Pierre','0722334455','pierre.fournier@email.fr', NULL),
('Girard','Sarah','0688665544','sarah.girard@email.fr', NULL),
('Lambert','Hugo','0611223366','hugo.lambert@email.fr', NULL),
('Masson','Julie','0733445566','julie.masson@email.fr', NULL),
('Henry','Arthur','0666554433','arthur.henry@email.fr', $2y$12$p0RWEbKK35pbH6RIvnEy1uQdzct7jfRYVY1s1T//hX7pypDgemG9m);

INSERT INTO travels (departure_agency_id, arrival_agency_id, departure_at, arrival_at, seats_total, seats_available, employee_id) VALUES
(9, 8, '2026-06-30 07:30:00.00', '2026-06-30 12:30:00.00', 4, 1, 1),
(10, 7, '2026-06-10 17:30:00.00', '2026-06-10 21:45:00.00', 2, 0, 1),
(1, 6, '2026-06-30 07:30:00.00', '2026-06-30 12:30:00.00', 4, 0, 1),
(8, 4, '2026-06-10 07:30:00.00', '2026-06-10 12:30:00.00', 4, 0, 1), 
(9, 2, '2026-06-10 07:30:00.00', '2026-06-10 12:30:00.00', 4, 0, 10),
(1, 3, '2026-06-10 07:30:00.00', '2026-06-10 12:30:00.00', 4, 2, 11),
(8, 10, '2026-06-30 07:30:00.00', '2026-06-30 12:30:00.00', 4, 0, 8),
(6, 8, '2026-06-10 07:30:00.00', '2026-06-10 12:30:00.00', 4, 0, 9),
(9, 1, '2026-07-02 07:30:00.00', '2026-07-02 12:30:00.00', 4, 4, 10),  
(12, 5, '2026-07-10 12:10:00.00', '2026-07-10 18:45:00.00', 4, 1, 15), 
(11, 4, '2026-07-22 07:30:00.00', '2026-07-22 12:30:00.00', 4, 3, 18); 