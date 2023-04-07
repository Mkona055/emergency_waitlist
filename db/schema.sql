CREATE TABLE IF NOT EXISTS patients (
    id VARCHAR(255) PRIMARY KEY DEFAULT gen_random_uuid(),
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    injury_severity INTEGER NOT NULL CHECK (injury_severity >= 0 AND injury_severity <= 4),
    code CHAR(3)  NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    came_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS admins (
    id VARCHAR(255) PRIMARY KEY DEFAULT gen_random_uuid(),
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

