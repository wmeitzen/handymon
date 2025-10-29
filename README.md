
![Language](https://img.shields.io/badge/Language-PHP-blue)
![Platform](https://img.shields.io/badge/Platform-Windows-lightgrey)
![Database](https://img.shields.io/badge/Backend-SQLite-blueviolet)
![Monitors](https://img.shields.io/badge/Targets-Windows%20%7C%20SQL%20Server-green)

![License](https://img.shields.io/badge/License-MIT-green)
![Status](https://img.shields.io/badge/Status-Stable-brightgreen)
[![Download](https://img.shields.io/badge/Download-Latest%20Setup.exe-orange)](https://github.com/handymon/handymon-setup-exe/releases/latest)
[![Issues](https://img.shields.io/github/issues/handymon/handymon.svg)](https://github.com/handymon/handymon/issues)

# Handymon - Simple, Free Windows Server & SQL Server Monitoring

Handymon is a lightweight, free monitoring tool for small businesses, schools, churches, and organizations with limited IT resources. It focuses on what matters most: sending alerts when servers, databases, or disks need attention.

Monitor multiple Windows Servers and SQL Server instances without limits. Receive timely notifications via email or Slack, schedule blackout periods for maintenance, and automate routine checks with background polling threads.

Built for the lone IT worker, Handymon is easy to install, simple to configure, and scales as your organization grows. No dashboards, no licensing fees, no unnecessary complexity - just reliable alerts when you need them.

Handymon - simple, free, and built to just work.

## Installation

There are two common ways to get Handymon:

- Download the official installer (recommended for most users):

	1. Visit the Releases page and download the latest `HandymonSetup.exe`.
	2. Run the installer on a Windows server or management workstation and follow the prompts.

- From source (for developers or advanced users):

	```powershell
	git clone https://github.com/wmeitzen/handymon.git
	cd handymon
	```

	See the `docs/` directory for detailed configuration examples and reference material.

## Quick start

1. After installing via the setup executable, open the Handymon configuration:
	 - Use the included `config.bat` (if present) or edit `config/config.xml` to add monitored servers, notification settings, and schedules.
2. Start the Handymon service or run the included scheduler/agent as described in the installer notes.
3. Confirm alerts by creating a test monitor (for example, a ping or SQL connection check) and trigger a notification to verify email/Slack settings.

For local development or to run checks manually, see `check/run_checks.php` and the `check/` utilities in the repository.

## Contributing

Contributions, bug reports and feature requests are welcome.

- Open an issue on GitHub to discuss bugs or feature ideas.
- Fork the repository and submit a pull request for code changes. Please include tests or reproduction steps when applicable.
- Keep changes small and focused; describe the goal and any compatibility notes in your PR.

## License

This project is provided under the MIT License — see the `LICENSE` file for details.

## Where to get help

- Browse the `docs/` folder in this repository for configuration and troubleshooting guides.
- Open an issue on GitHub if you need support or want to report a problem.

