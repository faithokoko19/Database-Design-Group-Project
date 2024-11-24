use events;
UPDATE registrations r
JOIN users u ON LOWER(r.user_name) = LOWER(u.name)
SET r.user_id = u.user_id;

SELECT 
    u.name AS user_name,
    u.email AS user_email,
    e.name AS event_name,
    e.event_date,
    e.venue,
    r.payment_status,
    r.registration_date
FROM 
    registrations r
INNER JOIN 
    users u ON r.user_id = u.user_id
INNER JOIN 
    events_list e ON r.event_id = e.event_id;

SELECT 
    u.name AS user_name,
    u.email AS user_email,
    e.name AS event_name,
    e.event_date,
    e.venue,
    r.payment_status,
    r.registration_date
FROM 
    users u
LEFT JOIN 
    registrations r ON u.user_id = r.user_id
LEFT JOIN 
    events_list e ON r.event_id = e.event_id;
