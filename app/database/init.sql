-- Drop the table if it exists
DROP TABLE IF EXISTS users;

-- Create the table
CREATE TABLE IF NOT EXISTS users (
     id INTEGER PRIMARY KEY AUTOINCREMENT,
     username TEXT NOT NULL UNIQUE,
     password TEXT NOT NULL
);

-- Drop the table if it exists
DROP TABLE IF EXISTS user_counters;

-- Create the user_counters table
CREATE TABLE IF NOT EXISTS user_counters (
     user_id INTEGER PRIMARY KEY,
     counter INTEGER DEFAULT 0,
     FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);