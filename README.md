## Security 

### Gitleaks

To ensure the security of AddingWell’s codebase, this repository uses Gitleaks to scan and detect potential sensitive information leaks within version control. Gitleaks is an open-source static analysis tool that helps identify secrets and sensitive data, protecting against accidental exposure and improving the overall security of the development lifecycle.

The implementation of Gitleaks in this repository allows you to:

- Detect secrets such as API keys, credentials, and tokens that may have been accidentally committed to the repository.
- Automate secret scanning across all branches and pull requests, ensuring sensitive data is identified early in the development process.
- Continuously monitor and validate that sensitive information is not exposed in the repository, reducing the risk of data breaches.
- Generate detailed reports on scan results, providing developers information to fix the problem.

### Add exception

Some Gitleaks detections may flag content that is not truly sensitive or is a false positive. In such cases, you can whitelist specific rules or files to prevent unnecessary alerts. To do so, comment the line where the secret is detected with this comment : `#gitleaks:allow`

```
SECRET=fake_password #gitleaks:allow
```

### Current exceptions

| Secret id                                                                                                            | Justification             |
|----------------------------------------------------------------------------------------------------------------------|---------------------------|


| 💡 Id are formed like this : <commit_hash>:<file_path>:<secret_type>:<line>
