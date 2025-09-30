# 🚀 GitHub Quick Start Guide

## Step 1: Login to GitHub
```
Email: ghamdixyz@gmail.com
Password: @@Myword11
```
Go to: [https://github.com](https://github.com)

## Step 2: Create Repository
1. Click **"+"** → **"New repository"**
2. Name: `qudrat100-wordpress`
3. Select **Private**
4. Click **"Create repository"**

## Step 3: Get Personal Access Token
⚠️ **Required for pushing code!**

1. Go to: Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Click **"Generate new token"**
3. Name: "WordPress Deployment"
4. Select: ✅ **repo** and ✅ **workflow**
5. Generate and **COPY TOKEN IMMEDIATELY**

## Step 4: Push Code to GitHub

Run these commands in your terminal:

```bash
# Configure Git
git config --global user.email "ghamdixyz@gmail.com"
git config --global user.name "Ghamdi"

# Add GitHub repository (replace YOUR_USERNAME with your GitHub username)
git remote add origin https://github.com/YOUR_USERNAME/qudrat100-wordpress.git

# Add all files
git add .

# Commit
git commit -m "Initial WordPress site deployment"

# Push (use Personal Access Token as password)
git push -u origin main
```

When prompted:
- Username: `ghamdixyz@gmail.com` or your GitHub username
- Password: **PASTE YOUR PERSONAL ACCESS TOKEN** (not @@Myword11)

## Step 5: Add Hosting Secrets

### Get your hosting details:
You need to get these from your hosting provider (cPanel or hosting support):
- FTP/SFTP server address
- FTP/SFTP username
- FTP/SFTP password
- Server directory path

### Add to GitHub:
1. Go to your repository: `https://github.com/YOUR_USERNAME/qudrat100-wordpress`
2. Click **Settings** → **Secrets and variables** → **Actions**
3. Add these secrets:

```
FTP_SERVER: [ask your host]
FTP_USERNAME: [ask your host]
FTP_PASSWORD: [ask your host]
FTP_PORT: 21
FTP_SERVER_DIR: /public_html/
```

## Step 6: Deploy

Every time you push to GitHub, it will automatically deploy:

```bash
# Make changes
git add .
git commit -m "Update site"
git push
```

## ⚠️ Security Reminder

1. **DELETE** the `DEPLOYMENT_CREDENTIALS.md` file after setup
2. **NEVER** commit passwords to GitHub
3. **USE** Personal Access Token for Git operations
4. **ENABLE** Two-Factor Authentication on GitHub

## Need Help?

- Check `GITHUB_DEPLOYMENT_GUIDE.md` for detailed instructions
- Contact your hosting provider for FTP/SFTP credentials
- GitHub Actions logs: Actions tab in your repository

---

**Ready to deploy! 🎉**