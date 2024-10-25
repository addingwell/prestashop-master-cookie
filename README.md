# Prestashop Master Cookie

A Prestashop module for adding the aw_master_id visitor cookie to your site

## Security 

### Bearer

To ensure the security of AddingWell’s codebase, this repository uses [Bearer](https://www.bearer.com/bearer-cli) to scan and detect vulnerabilities in code. Bearer is an open-source static analysis tool, improving the overall security of the development lifecycle.

### Add exception

Some Bearer detections may flag content that is a false positive. In such cases, you can whitelist specific findings to prevent unnecessary alerts. To do so, use `bearer:disable` comment immediately before the block where the vulnerability is found.

```
// bearer:disable php_lang_exception
throw new Exception("error for {$user->email}");
```

### Current exceptions

There are no exceptions yet.

| Rule ID                  | File                        | Justification         |
| ------------------------ | --------------------------- | --------------------- |
| _Eg: php_lang_exception_ | _Eg: mastercookie/index.php:34_ | _Eg: Write justification_ |
