-- Seed Data for DIN Database (MySQL/MariaDB compatible)

-- Default Admin User (Password: Admin@123)
INSERT IGNORE INTO `users` (`name`, `email`, `password_hash`, `role`)
VALUES ('DIN Admin', 'admin@dantworf.org', '$2y$10$wE98T7qY4Vl8y7M9wHqQEuq4R9aE7XvKq9W9V5uT0p9bQ3P8gZ3iG', 'admin');

-- Initial Settings
INSERT IGNORE INTO `settings` (`setting_key`, `setting_value`, `description`)
VALUES
    ('site_name', 'DANTWORF INSPIRES NETWORK', 'Main website title'),
    ('contact_email', 'info@dantworf.org', 'Public contact email address'),
    ('phone_number', '+1234567890', 'Main contact phone number'),
    ('address', '123 Inspiration Way, Education City', 'Physical headquarters address');

-- Seed a Welcome Blog Post
INSERT INTO `blogs` (`title`, `content`, `status`)
VALUES ('Welcome to DIN', '<p>Welcome to the Dantworf Inspires Network. We are excited to empower the next generation of leaders.</p>', 'published');

-- Seed a Sample Event
INSERT INTO `events` (`title`, `description`, `event_date`, `location`)
VALUES ('Annual Leadership Summit', 'Join us for our yearly gathering of student leaders.', DATE_ADD(NOW(), INTERVAL 30 DAY), 'Main Campus Auditorium');
