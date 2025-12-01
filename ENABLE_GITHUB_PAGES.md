# Enable GitHub Pages - Manual Steps

## ⚠️ Important: Enable GitHub Pages in Repository Settings

The workflow is trying to deploy but GitHub Pages needs to be enabled first.

### Steps to Enable GitHub Pages:

1. **Go to your repository:**
   https://github.com/BsalBhandari/ase230-bhandari-project2

2. **Click on "Settings"** (top menu bar)

3. **Scroll down to "Pages"** (left sidebar)

4. **Under "Source":**
   - Select: **"GitHub Actions"**
   - (Not "Deploy from a branch")

5. **Click "Save"**

6. **Go back to Actions tab:**
   - The workflow should automatically re-run
   - Or manually trigger it by clicking "Run workflow"

### Alternative: If the workflow parameter doesn't work

If the `enablement: true` parameter doesn't work, you must enable it manually in Settings → Pages first, then the workflow will work.

---

## After Enabling:

1. Wait for the workflow to complete (2-3 minutes)
2. Visit: https://bsalbhandari.github.io/ase230-bhandari-project2/
3. Your Hugo site should be live!

---

## Quick Link:
**Repository Settings → Pages:**
https://github.com/BsalBhandari/ase230-bhandari-project2/settings/pages

