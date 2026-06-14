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
('Martin','Alexandre','0612345678','alexandre.martin@email.fr', NULL),
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
('Henry','Arthur','0666554433','arthur.henry@email.fr', NULL);

INSERT INTO travels (departure_agency_id, arrival_agency_id, departure_at, arrival_at, seats_total, seats_available, employee_id) VALUES
(10, 2, '2026-06-01 18:53:24.00', '2026-06-01 18:58:24.00', 4, 4, 1),
(10, 2, '2026-06-05 07:20:00.00', '2026-06-05 12:30:00.00', 4, 0, 2),
(10, 2, '2026-06-16 07:20:00.00', '2026-06-16 12:30:00.00', 4, 3, 20);