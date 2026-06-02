-- Seed Data for DIN Database

-- Default Admin User (Password is 'Admin@123' hashed with PHP password_hash)
INSERT INTO users (name, email, password_hash, role) 
VALUES ('DIN Admin', 'admin@dantworf.org', '$2y$10$wE98T7qY4Vl8y7M9wHqQEuq4R9aE7XvKq9W9V5uT0p9bQ3P8gZ3iG', 'admin')
ON CONFLICT (email) DO NOTHING;

-- Initial Settings
INSERT INTO settings (setting_key, setting_value, description) 
VALUES 
    ('site_name', 'DANTWORF INSPIRES NETWORK', 'Main website title'),
    ('contact_email', 'info@dantworf.org', 'Public contact email address'),
    ('phone_number', '+1234567890', 'Main contact phone number'),
    ('address', '123 Inspiration Way, Education City', 'Physical headquarters address')
ON CONFLICT (setting_key) DO NOTHING;

-- Seed a Welcome Blog Post
INSERT INTO blogs (title, content, status) 
VALUES 
    ('Welcome to DIN', '<p>Welcome to the Dantworf Inspires Network. We are excited to empower the next generation of leaders.</p>', 'published');

-- Seed a Sample Event
INSERT INTO events (title, description, event_date, location)
VALUES
    ('Annual Leadership Summit', 'Join us for our yearly gathering of student leaders.', CURRENT_TIMESTAMP + INTERVAL '30 days', 'Main Campus Auditorium');
