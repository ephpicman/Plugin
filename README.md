# Ephpicman Plugin Starter

A reusable starter repository for building independent Ephpicman WordPress plugins. It provides a small plugin lifecycle, shared EPM integration, translation automation, and basic CI. It intentionally does not include product-specific features or unnecessary abstractions.

## Platform requirements

The starter's minimum platform requirements are:

- **PHP 8.0**
- **WordPress 6.3**

EPM requires PHP 8.0 or newer, so derived plugins must not lower the PHP minimum below 8.0. WordPress 6.3 and later are documented as fully supporting PHP 8.0. Products may raise either minimum when their code or dependencies require it, but must not lower either floor.

These are minimum compatibility declarations, not recommendations to run obsolete software. For production sites, use actively supported WordPress and PHP releases.

## Repository structure

```text
index.php                         Plugin header, bootstrap, and lifecycle hooks
src/Plugin.php                    Plugin lifecycle and initialization
epm/                              Shared EPM code, synchronized from Ephpicman/EPM
languages/                        POT template and translated PO/MO catalogs
.github/workflows/php-lint.yml    PHP syntax checks
.github/workflows/translations.yml Translation catalog generation and compilation
.github/workflows/sync-epm.yml    Scheduled and manual EPM synchronization
phpcs.xml.dist                    WordPress Coding Standards configuration
LICENSE                           GPL-2.0-or-later license notice
```

The EPM workflow expects repository write permission so it can commit synchronized changes. Translation generation also needs contents write permission to commit updated catalogs.

## Creating a plugin from this template

After creating a repository from this template, complete the following checklist before treating it as a product repository.

### 1. Rename and identify the plugin

Update all starter identity values, including:

- Plugin name and description in the header of `index.php`.
- Plugin URI and author details.
- Plugin folder/repository slug and installation instructions.
- PHP namespace in `src/Plugin.php` and the matching namespace passed to `EpmLoader::register()`.
- Text Domain in `index.php`, every translation call, and translation filenames.
- The package name in PHPDoc `@package` annotations.
- The plugin file constant name if you want a product-specific constant. Update every reference if it is renamed.
- README title, links, examples, and any product-specific documentation.

Keep the namespace unique to the product. Keep the Text Domain stable and unique to the plugin; it should match the plugin slug according to WordPress plugin internationalization conventions. Do not rename the translation files independently of the Text Domain.

### 2. Set platform requirements

The starter declares `Requires PHP: 8.0` and `Requires at least: 6.3` in `index.php`. Update these declarations if the product needs newer versions. Also update `phpcs.xml.dist`, CI coverage, and this documentation when changing the tested minimum.

**Do not lower the PHP minimum below 8.0 or the WordPress minimum below 6.3.** EPM requires PHP 8.0 or newer. A product can increase the minimums, but cannot safely lower the shared foundation's requirements.

### 3. Configure translations

- Keep translatable user-facing strings in WordPress internationalization functions such as `__()`, `_e()`, `esc_html__()`, and `esc_attr__()` as appropriate.
- Use the product's Text Domain consistently.
- Keep the `.po` source catalog under version control; the workflow generates the `.pot` catalog and compiles `.mo` files.
- Review generated translation changes and verify that real translations are preserved.
- Remove starter/test strings and test translations that are not part of the product.

The translation workflow currently updates `languages/ephpicman-plugin-fa_IR.po` when that file exists. If you rename the Text Domain or translation catalog, update `.github/workflows/translations.yml` to use the new filenames and domain.

### 4. Add product behavior

Implement product-specific code under `src/`. Keep shared framework code in `epm/`; that directory is maintained by the EPM synchronization workflow and should not be used for product-specific classes.

Add new abstractions only when they solve a real requirement. Do not add empty classes or generic infrastructure preemptively.

### 5. Review lifecycle hooks and data handling

The starter registers activation and deactivation callbacks. Add work to these methods only when the product needs it. If the plugin later stores persistent data that should be removed on uninstall, design and document an explicit uninstall policy at that time. Do not add uninstall cleanup when there is no product data to clean up.

For all product features, validate and sanitize input, check capabilities and nonces for privileged actions, use WordPress APIs, and escape output at the point where it is rendered. Do not commit secrets, credentials, environment-specific values, or production data.

### 6. Review CI and repository settings

- Confirm the PHP lint workflow passes.
- Run WordPress Coding Standards checks locally or add them to CI if that is part of the product's quality gate.
- Confirm the translation workflow uses the product's Text Domain and catalog filenames.
- Confirm EPM synchronization succeeds and that the expected `epm/bootstrap.php` and `epm/src/` files are present.
- Check that the repository's Actions permissions allow only the writes required by the workflows.
- Enable branch protection and require the appropriate checks before merging when the repository is ready for team development.

The PHP lint workflow checks PHP syntax; it does not prove that WordPress can activate the plugin or that EPM initializes correctly. Test activation and product behavior in a WordPress environment before releasing a product.

## Development

1. Clone the repository into a WordPress installation's `wp-content/plugins/<plugin-slug>` directory.
2. Complete the customization checklist above.
3. Activate the plugin in WordPress.
4. Add product-specific behavior under `src/`.
5. Run PHP syntax and coding-standard checks before pushing changes.

## EPM synchronization

GitHub Actions synchronizes `Ephpicman/EPM` `main` into `epm/` daily at 09:00 Asia/Tehran and supports manual runs from **Actions → Sync EPM → Run workflow**. The workflow uses `git subtree` with `--squash`, so it does not import EPM's full commit history.

After creating a repository from the template, verify the first synchronization run. Do not assume the shared code is present until the workflow succeeds.

## License

This starter is distributed under **GNU General Public License version 2 or, at your option, any later version (GPL-2.0-or-later)**. See [LICENSE](LICENSE) and the [GNU GPL version 2 text](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html).

## Design principles

- Keep the foundation small and maintainable.
- Treat EPM as shared infrastructure and keep product code separate.
- Guard direct access to PHP files.
- Use WordPress APIs and escape output at the point of rendering.
- Prefer quick validation before adding features or abstractions.
- Raise platform requirements when a product needs to, but never lower them beneath the shared EPM floor.
- Do not store secrets or environment-specific configuration in the repository.
