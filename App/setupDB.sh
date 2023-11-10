#!/bin/bash

sqlite3 db/app.db '.read db/schema.sql'
sqlite3 db/app.db '.read db/seed.sql'