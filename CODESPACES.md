# Run CareOps AI in GitHub Codespaces

1. Create a new GitHub repository.
2. Upload all files/folders from this ZIP to the repository root. Make sure `.devcontainer` is included.
3. Commit the files.
4. Click **Code → Codespaces → Create codespace on main**.
5. GitHub will build the development container and run `.devcontainer/setup.sh`.
6. When setup completes, open the **PORTS** tab.
7. Open port **5173** for the React UI.
8. Port **8000** is the Laravel API.

If services need restarting:
```bash
bash .devcontainer/start.sh
```

Useful checks:
```bash
docker compose ps
curl http://localhost:8000/api/v1/health
```

Note: this is still a development/pilot scaffold using mock providers and synthetic patient data.
