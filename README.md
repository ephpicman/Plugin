# Ephpicman Plugin Starter

A lightweight, production-minded starting point for custom WordPress plugins. Shared Ephpicman infrastructure is synchronized into `epm/` from [Ephpicman/EPM](https://github.com/ephpicman/EPM).

## Requirements

- WordPress 6.4+
- PHP 7.4+

## Structure

```
index.php                 Main plugin entry point and lifecycle hooks
ephpicman-plugin.php      Temporary compatibility loader for existing installs
src/Plugin.php             Plugin lifecycle and initialization
epm/                       Shared EPM code (automatically synchronized)
languages/                 Translation catalogs
uninstall.php              Safe uninstall entry point
.github/workflows/         CI, translation generation, and EPM synchronization
```

## Development

1. Clone this repository into `wp-content/plugins/ephpicman-plugin`.
2. Activate **Ephpicman Plugin Starter** in WordPress.
3. Add plugin-specific behavior under `src/`; keep shared infrastructure in `epm/`.
4. Run PHP syntax checks before pushing changes.

The legacy `ephpicman-plugin.php` file is retained as a compatibility loader. It migrates the stored active-plugin path to `index.php` for existing single-site and multisite installations, then loads the new entry point. It can be removed in a future release after the migration period.

## EPM synchronization

GitHub Actions syncs `Ephpicman/EPM` `main` into `epm/` every day at 09:00 Asia/Tehran and supports manual runs from **Actions → Sync EPM → Run workflow**. Sync uses `git subtree` with `--squash`, so it does not import EPM's full commit history.

The workflow needs repository contents write permission. Check the Actions run after the first setup to confirm the initial `epm/` import completed.

## Design principles

- Guard direct access to PHP files.
- Use WordPress APIs and escape output at the point of rendering.
- Keep the initial framework small; add abstractions only when a real plugin needs them.
- Do not place secrets or environment-specific configuration in the repository.
