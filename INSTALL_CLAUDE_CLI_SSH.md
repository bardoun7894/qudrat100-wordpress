# 🤖 Install Claude CLI on Hostinger SSH

## 🎯 Installing Claude CLI via SSH

### Step 1: Connect to SSH
```bash
ssh -p 65002 u336527051@82.29.185.27
```

### Step 2: Install Node.js (if not already installed)
```bash
# Check if Node.js is installed
node --version

# If not installed, you'll need to install it
# On Hostinger shared hosting, Node.js might already be available
```

### Step 3: Install Claude Code CLI
```bash
# Install Claude Code globally via npm
npm install -g @anthropic-ai/claude-code

# Or if you don't have npm permissions on shared hosting:
npx @anthropic-ai/claude-code
```

---

## ⚠️ Important Note for Shared Hosting

**Hostinger shared hosting may have limitations:**
- Limited npm install permissions
- May not have Node.js installed
- Restricted access to global installations

---

## 🔄 Alternative: Use Claude Locally + SSH

**Better approach for your use case:**

### Option 1: Use Claude Code Locally with SSH Commands
Use Claude Code on your Windows computer to generate SSH commands, then run them manually.

### Option 2: Use VS Code Remote SSH
```bash
# In VS Code, install "Remote - SSH" extension
# Connect to: ssh://u336527051@82.29.185.27:65002
# Then use Claude Code extension in VS Code connected to remote
```

### Option 3: Direct File Editing via SSH
```bash
# Edit files directly via nano or vim
nano ~/public_html/wp-content/themes/custom-theme/functions.php
```

---

## 🎯 What You Actually Need Right Now

**Instead of installing Claude on the server, let's just fix the CSS issue!**

### Quick Fix Commands:
```bash
# 1. Connect to SSH
ssh -p 65002 u336527051@82.29.185.27

# 2. Check if assets folder exists
ls -la ~/public_html/assets/

# 3. If assets folder is MISSING, upload it from your local computer:
exit  # Exit SSH first

# 4. Upload assets folder (from your Windows computer):
scp -P 65002 -r "C:\Users\Chairi\wordpress\assets" u336527051@82.29.185.27:~/public_html/

# 5. Reconnect and verify:
ssh -p 65002 u336527051@82.29.185.27
ls -la ~/public_html/assets/css/style.css
```

---

## 💡 Recommended Workflow

**Best approach:**
1. **Use Claude Code locally** (on your Windows PC)
2. **Generate commands** using Claude
3. **Run commands** via SSH manually
4. **Or use SCP** to upload files

**This avoids the complexity of installing tools on shared hosting!**

---

## 🚀 Let's Focus on Fixing Your CSS Issue First

**Instead of installing Claude on server, let's:**

1. **Check if assets folder exists:**
   ```bash
   ssh -p 65002 u336527051@82.29.185.27
   ls ~/public_html/assets/
   ```

2. **Upload assets if missing:**
   ```bash
   scp -P 65002 -r assets u336527051@82.29.185.27:~/public_html/
   ```

3. **Test the fix:**
   - Visit https://qudrat100.com
   - Should now match demo.php styling!

---

**Want to focus on fixing the CSS issue first? That's more urgent than installing Claude on the server! 🎯**