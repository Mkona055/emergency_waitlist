CREATE TABLE IF NOT EXISTS patients (
    id VARCHAR(255) PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    injury_severity INTEGER NOT NULL CHECK (injury_severity >= 0 AND injury_severity <= 4),
    code CHAR(3) UNIQUE NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    came_at TIMESTAMP NOT NULL DEFAULT NOW(),
    served BOOLEAN NOT NULL DEFAULT FALSE
);

INSERT INTO patients (id, first_name, last_name, injury_severity, code, email, phone) 
VALUES  ('1', 'John', 'Doe', 1, 'ABC', 'john@gmail.com', '1234567890'),
        ('2', 'Jane', 'Doe', 2, 'DEF', 'Jane@gmail.com', '1234567890'),
        ('3', 'John', 'Smith', 3, 'GHI', 'jsmith@gmail.com', '1234567890'),
        ('4', 'Jane', 'Smith', 4, 'JKL', 'janesmith@gmail.com', '1234567890')
