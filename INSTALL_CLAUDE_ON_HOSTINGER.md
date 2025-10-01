# 🤖 Install Claude CLI on Hostinger Server

## 🎯 What You Need

Claude CLI requires:
1. **Node.js** (v18 or higher)
2. **npm** (Node Package Manager)
3. **Claude API Key** (from Anthropic)

---

## ✅ Step-by-Step Installation

### Step 1: Connect to SSH
```bash
ssh -p 65002 u336527051@82.29.185.27
```
Password: `Myword11@@`

---

### Step 2: Check if Node.js is Installed
```bash
node --version
npm --version
```

**If you see versions (like v18.x.x), skip to Step 4**
**If "command not found", continue to Step 3**

---

### Step 3: Install Node.js (if not installed)

#### Option A: Using NVM (Recommended)
```bash
# Install NVM (Node Version Manager)
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash

# Reload shell configuration
source ~/.bashrc

# Install Node.js LTS
nvm install --lts

# Verify installation
node --version
npm --version
```

#### Option B: Download Node.js Binary (if NVM doesn't work)
```bash
# Create local bin directory
mkdir -p ~/bin

# Download Node.js v20 (latest LTS)
cd ~
wget https://nodejs.org/dist/v20.11.0/node-v20.11.0-linux-x64.tar.xz

# Extract
tar -xf node-v20.11.0-linux-x64.tar.xz

# Move to bin
mv node-v20.11.0-linux-x64 ~/node

# Add to PATH
echo 'export PATH=$HOME/node/bin:$PATH' >> ~/.bashrc
source ~/.bashrc

# Verify
node --version
npm --version
```

---

### Step 4: Install Claude CLI
```bash
# Install Claude Code CLI globally
npm install -g @anthropic-ai/claude-code

# Or install locally (if global fails on shared hosting)
npm install @anthropic-ai/claude-code

# Verify installation
claude --version
```

---

### Step 5: Configure Claude CLI with API Key

#### Get Your API Key:
1. Go to: https://console.anthropic.com/
2. Sign in with your Anthropic account
3. Navigate to **API Keys**
4. Create a new key or copy existing one

#### Set API Key:
```bash
# Set environment variable
export ANTHROPIC_API_KEY="your-api-key-here"

# Make it permanent
echo 'export ANTHROPIC_API_KEY="your-api-key-here"' >> ~/.bashrc
source ~/.bashrc

# Verify
echo $ANTHROPIC_API_KEY
```

---

### Step 6: Test Claude CLI
```bash
# Navigate to your WordPress directory
cd ~/domains/qudrat100.com/public_html

# Test Claude
claude --help

# Or use npx if global install didn't work
npx @anthropic-ai/claude-code --help
```

---

## 🚀 Quick Install Script (Copy-Paste All)

```bash
# Connect to SSH first
ssh -p 65002 u336527051@82.29.185.27

# Then run this complete script:
cd ~

# Install NVM
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
source ~/.bashrc

# Install Node.js
nvm install --lts

# Install Claude CLI
npm install -g @anthropic-ai/claude-code

# Set API key (replace with your actual key)
echo 'export ANTHROPIC_API_KEY="sk-ant-your-key-here"' >> ~/.bashrc
source ~/.bashrc

# Test
claude --version

echo "✅ Claude CLI installed successfully!"
```

---

## 🔧 Using Claude CLI on Your WordPress Site

After installation, you can use Claude to edit files directly on the server:

```bash
# Navigate to WordPress
cd ~/domains/qudrat100.com/public_html

# Use Claude to fix your theme
claude "Fix the custom-theme to match the localhost version"

# Or specific tasks
claude "Update functions.php to load CSS correctly"
claude "Activate custom-theme and clear cache"
```

---

## ⚠️ Important Notes for Shared Hosting

### If npm global install fails:
```bash
# Use local installation instead
cd ~
npm install @anthropic-ai/claude-code

# Then use via npx
npx @anthropic-ai/claude-code --help
```

### If Node.js can't be installed:
**Hostinger shared hosting may not allow Node.js installation**

**Alternative**: Use Claude locally on your Windows PC and generate SSH commands:
1. Use Claude on your PC
2. Ask it to generate SSH/WP-CLI commands
3. Copy-paste commands to server via SSH

---

## 🎯 What Claude CLI Can Do for You

Once installed on the server, Claude can:
- ✅ Edit theme files directly
- ✅ Update WordPress configurations
- ✅ Debug PHP errors
- ✅ Optimize database queries
- ✅ Fix CSS/JavaScript issues
- ✅ Manage WordPress via WP-CLI
- ✅ All without downloading/uploading files!

---

## 📋 Troubleshooting

### Error: "npm: command not found"
**Solution**: Node.js not installed. Go back to Step 3.

### Error: "Permission denied"
**Solution**: Use local install instead of global:
```bash
npm install @anthropic-ai/claude-code
npx @anthropic-ai/claude-code --help
```

### Error: "Cannot find module"
**Solution**: Install in user directory:
```bash
cd ~
npm install @anthropic-ai/claude-code
alias claude="npx @anthropic-ai/claude-code"
```

---

**Start with Step 1 and follow each step carefully! 🚀**

**Once Claude is installed on the server, you can edit your WordPress files directly without uploading! 🎉**
