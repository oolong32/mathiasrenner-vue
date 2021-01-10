# mathiasrenner-vue

Built with [Craft-Vue](https://github.com/chasegiunta/craft-vue/).

## Installation

1. `git clone git@github.com:oolong32/mathiasrenner-vue.git` 
2. `composer install`
3. set up empty database
4. `./craft install` (or better, use existing `.env` file)
5. `npm install`
6. `npm install --save-dev @vue/cli @vue/cli-service-global core-js@3`

## Managing Remote Repo

Updates are made in the local repo with `composer update`.

On Staging/Production it’s first `git pull origin master`, then `composer install`.

`composer update` on remote is no catastrophe, but it will rewrite `package.lock`, which needs to be stashed before pulling next time.

## Dev/Vue

- `npm run dev` (local development)
- `npm run build` (before deploying)

### Vue Components

- Vue components are automatically registred, when they are in a subfolder of `/src/components/`.
- naming in camelcase:
    - `FooBar`
    - redundant but consistent: set component name to same Value (`name: "FooBar"`)

### Twig

- the vue app is registred in `/template/_layout.twig`
- every twig template starts with `{% extends "_layout" %}`
- components can be used like `<foo-bar></foo-bar>`
- beware: no self closing tags for components in twig!
- props: `<foo-bar :myprop="{{ twigvariable }}">`
- objects as props need to be converted to json: `<foo-bar :myprop="{{ twigobject|json_encode }}">`
- this can be done in the module
- set default for prop that can be absent: `myprop="{{ twigvariable|default('hello') }}"`

### Sass

Stylesheets are in `/src/sass/`

## Server

### Deploy

Always **clear the cache** after pulling npm build files (Craft CP, Tools).

- before push: `npm run build`
- after pushing changes to the backend, run `php craft project-config/apply` on the server.
- after pushing changes to the module it might be neccessary to run `composer dump-autoload -a` on the server.
- after pull: run `php craft clear-caches/all` to empty cache in craft’s cp or 

### Environments

#### Staging

[staging.mathiasrenner.ch](https://staging.mathiasrenner.ch)

#### Production

[mathiasrenner.ch](https://mathiasrenner.ch)

#### htaccess

(seems irrelevant, still from older project)

The folder `web` needs a `.htaccess` file, otherwise `/admin` gets 404.

    <IfModule mod_rewrite.c>
        RewriteEngine On

        # cors
        Header set Access-Control-Allow-Origin "*"

        # Send would-be 404 requests to Craft
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_URI} !^/(favicon\.ico|apple-touch-icon.*\.png)$ [NC]
        RewriteRule (.+) index.php?p=$1 [QSA,L]
    </IfModule>

## Module

### Twig Variables

The functions in `modules/edelmannkrellmodule/src/variables/EdelmannKrellModuleVariable.php` return values that are accessible in twig, such as `craft.edelmannKrellModule.projectsListedByType`.

See [craft documentation](https://craftcms.com/docs/3.x/extend/module-guide.html) for infos.


