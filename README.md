# URL shortener

*URL shortener* is simple software, which can startup your own URL shortener service.

*URL shortener* includes also URL unshortener, to unshorten any shortened link. 

## Instalation

1. [Download](https://gitlab.com/per_voj/url-shortener/-/releases) this project
2. Upload files on your hosting
3. Edit .htconfig file
4. Setup database (guide bellow)
5. Enjoy finished work!

### Database setup

Create database with any name and create table called `shorted` into it.

Table configuration:

|Column|Type|Other|
|------|----|-----|
|`id`|`int`|`primary key`, `auto increment`|
|`url`|`text`||
|`code`|`text`||
|`stat`|`int`||

## Did you find an issue? Do you have an idea?

Please use Issues to report a problem or idea. Select the appropriate template. If the paragraphs do not suit you, you can edit them or delete unused ones. Please do not use tags.