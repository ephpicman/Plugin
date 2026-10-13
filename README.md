# Ephpicman Plugin Starter

A lightweight, production-minded starting point for custom WordPress plugins. Shared Ephpicman infrastructure is synchronized into `epm/` from [Ephpicman/EPM](https://github.com/ephpicman/EPM).

## Requirements

- WordPress 6.4+
- PHP 7.4+

## Structure

```
ephpicman-plugin.php     Plugin entry point and lifecycle hooks
includes/
  class-plugin.php       Main plugin bootstrap
  class-activator.php    Activation routines
  class-deactivator.php  Deactivation routines
epm/                     Shared EPM code (automatically synchronized)
uninstall.php            Safe uninstall entry point
.github/workflows/
  sync-epm.yml           Daily EPM sync and manual trigger
```

## Development

1. Clone this repository into `wp-content/plugins/ephpicman-plugin`.
2. Activate **Ephpicman Plugin Starter** in WordPress.
3. Add plugin functionality in focused classes under `includes/`; keep product-specific behavior out of the shared `epm/` directory.
4. Run PHP syntax checks before pushing changes.

## EPM synchronization

GitHub Actions syncs `Ephpicman/EPM` `main` into `epm/` every day at 09:00 Asia/Tehran and supports manual runs from **Actions → Sync EPM → Run workflow**. Sync uses `git subtree` with `--squash`, so it does not import EPM's full commit history.

The workflow needs repository contents write permission. Check the Actions run after the first setup to confirm the initial `epm/` import completed.

## Design principles

- Guard direct access to PHP files.
- Use WordPress APIs and escape output at the point of rendering.
- Keep the initial framework small; add abstractions only when a real plugin needs them.
- Do not place secrets or environment-specific configuration in the repository.
