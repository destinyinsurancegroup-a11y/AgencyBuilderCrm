Agency Builder CRM - Known Good Configuration Snapshot

This archive contains the last confirmed working setup for the live DigitalOcean deployment.

Included Files:
- .env.reference        → Environment variables (placeholders only)
- nginx.conf.reference  → Web server config used on DigitalOcean
- artisan_commands.txt  → Commands to run after each deployment
- readme_reference.md   → This document

Environment Summary:
- Laravel 10, PHP 8.2
- PostgreSQL 15, Redis, S3 (DigitalOcean Spaces)
- Stripe billing (live keys)
- Deployment via GitHub → DigitalOcean App Platform

Status at Confirmation:
✓ Login page loaded
✓ Dashboard visible
✓ Database connected
✓ Stripe test checkout successful
⚙ Multi-tenancy partially complete
