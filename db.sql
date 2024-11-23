Create database events;
use events;
Create table users (
    user_id int auto_increment primary key,
    name varchar(100),
    email varchar(100) unique,
    password varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
create table events_list (
    event_id int auto_increment primary key,
    name varchar(255),
    description text,
    event_date datetime,
    venue varchar(100),
    total_seats int
);


CREATE TABLE registrations (
    registration_id int auto_increment primary key,
    user_id int,
    event_id int,
    payment_status ENUM('Pending', 'Completed') DEFAULT 'pending',
	registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (user_id) references users(user_id),
    foreign key (event_id) references events_list(event_id)
);

INSERT INTO events_list (name, description, event_date, venue, total_seats) VALUES
( 'Mountain Resort, Colorado', 100),
('Football Championship', 'The annual football championship featuring top teams.', '2024-12-18 15:00:00', 'Sports Complex, Miami', 20000),
('Film Premiere', 'Exclusive premiere of a highly anticipated blockbuster film.', '2024-12-01 19:00:00', 'Cineplex Theater, Los Angeles', 1500),
('Tech Expo 2024', 'A tech expo showcasing cutting-edge technologies and innovations.', '2024-11-30 09:00:00', 'Convention Center, Boston', 5000),
('Winter Wonderland Concert', 'An outdoor concert with live performances in a winter wonderland.', '2024-12-20 17:00:00', 'Snowy Fields, Aspen', 3000),
('Fashion Show', 'A glamorous fashion show featuring renowned designers.', '2024-11-25 18:00:00', 'Grand Ballroom, Milan', 600),
('Charity Gala', 'A fundraising gala event to support various charities.', '2024-12-03 19:00:00', 'Royal Hall, London', 1000),
('Science Fair 2024', 'A fair showcasing innovative scientific projects from students.', '2024-11-26 10:00:00', 'Exhibition Center, Toronto', 800),
('Jazz Festival', 'A vibrant jazz music festival featuring performances by top artists.', '2024-12-12 16:00:00', 'Jazz Park, New Orleans', 1200),
('Marathon Race', 'An annual marathon race where participants run for charity.', '2024-11-27 08:00:00', 'City Streets, Boston', 5000);

ALTER TABLE registrations ADD COLUMN user_name VARCHAR(255) NOT NULL;
ALTER TABLE registrations ADD COLUMN user_email VARCHAR(255) NOT NULL;

