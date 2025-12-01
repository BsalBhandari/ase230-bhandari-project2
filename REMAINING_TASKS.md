# Remaining Tasks for Project 2 Submission

## ✅ Completed

- ✅ Laravel API implementation (all endpoints)
- ✅ Eloquent ORM models with relationships
- ✅ Laravel Sanctum authentication
- ✅ Shell script deployment (`run.sh`)
- ✅ Docker deployment (`setup.sh`, Dockerfile, docker-compose.yml)
- ✅ Hugo documentation site
- ✅ GitHub Actions workflow configured
- ✅ Screenshots captured

---

## 📋 Remaining Tasks

### 1. Organize Screenshots (5 minutes)

**Current screenshots:**
- `api:courses.png`
- `database migration.png`
- `hugo.png`
- `localhost 8080.png`
- `run sh.png`

**Rename to match rubric:**
```bash
cd "/Users/bsal/Desktop/College/server /project 1/ase230-bhandari-project2/presentation/screenshots"

# Rename screenshots
mv "run sh.png" run-script.png
mv "hugo.png" hugo-build.png
# Keep database migration.png as part of run-script or combine
# Keep api:courses.png for reference
# Keep localhost 8080.png for docker-setup reference
```

**Still need:**
- `docker-setup.png` - Capture `./setup.sh` execution and `docker compose ps`
- `github-actions.png` - After pushing to GitHub

---

### 2. Initialize Git and Push to GitHub (10 minutes)

```bash
cd "/Users/bsal/Desktop/College/server /project 1/ase230-bhandari-project2"

# Initialize git if not already done
git init

# Add all files
git add .

# Commit
git commit -m "Project 2 submission - Laravel REST API with Docker and Hugo"

# Add remote (if not already added)
git remote add origin https://github.com/BsalBhandari/ase230-bhandari-project2.git

# Push to GitHub
git push -u origin main
```

**Verify:**
- Code is on GitHub: https://github.com/BsalBhandari/ase230-bhandari-project2
- GitHub Actions workflow runs successfully
- Capture screenshot of GitHub Actions workflow

---

### 3. Verify GitHub.io Deployment (5 minutes)

After pushing to GitHub:
1. Wait for GitHub Actions to complete (check Actions tab)
2. Visit: https://bsalbhandari.github.io/ase230-bhandari-project2/
3. Verify site is accessible
4. Capture screenshot of:
   - GitHub Actions workflow success
   - GitHub.io site in browser

---

### 4. Create Zip Files (5 minutes)

**Create code zip (exclude vendor, node_modules, .git):**
```bash
cd "/Users/bsal/Desktop/College/server /project 1/ase230-bhandari-project2"

# Zip code directory
cd code
zip -r ../ase230-bhandari-project2-code.zip . \
  -x "*.git*" \
  -x "vendor/*" \
  -x "node_modules/*" \
  -x "*.log" \
  -x "storage/logs/*" \
  -x "storage/framework/cache/*" \
  -x "database/database.sqlite" \
  -x ".env"

# Check size
ls -lh ../ase230-bhandari-project2-code.zip
```

**Create presentation zip:**
```bash
cd "/Users/bsal/Desktop/College/server /project 1/ase230-bhandari-project2"

# Zip presentation directory
cd presentation
zip -r ../ase230-bhandari-project2-presentation.zip . \
  -x "*.git*" \
  -x "public/*" \
  -x "resources/_gen/*" \
  -x "themes/PaperMod/.git/*"

# Check size
ls -lh ../ase230-bhandari-project2-presentation.zip
```

**Verify:**
- No `.git` directories included
- File sizes are reasonable (not too large)
- All required files included

---

### 5. Fill Out Grading Rubric (15 minutes)

Open `GRADING_RUBRIC.md` and fill in:
- [ ] All checkboxes
- [ ] Screenshot filenames
- [ ] Zip file sizes
- [ ] GitHub repository links
- [ ] GitHub.io link
- [ ] Self-assessment scores

---

### 6. Final Verification (5 minutes)

Checklist:
- [ ] All code files present
- [ ] All scripts executable (`run.sh`, `setup.sh`)
- [ ] Docker files present
- [ ] Hugo site builds successfully
- [ ] Screenshots in `presentation/screenshots/`
- [ ] GitHub repository pushed
- [ ] GitHub.io site accessible
- [ ] Zip files created
- [ ] Grading rubric filled out
- [ ] No unnecessary files (helper docs removed)

---

## 🎯 Quick Command Summary

```bash
# 1. Organize screenshots
cd presentation/screenshots
mv "run sh.png" run-script.png
mv "hugo.png" hugo-build.png

# 2. Push to GitHub
cd "/Users/bsal/Desktop/College/server /project 1/ase230-bhandari-project2"
git add .
git commit -m "Project 2 submission"
git push origin main

# 3. Create zip files
cd code && zip -r ../ase230-bhandari-project2-code.zip . -x "vendor/*" "*.git*" "node_modules/*" "*.log" "storage/logs/*" "database/database.sqlite" ".env"
cd ../presentation && zip -r ../ase230-bhandari-project2-presentation.zip . -x "*.git*" "public/*" "resources/_gen/*"

# 4. Check file sizes
ls -lh ../ase230-bhandari-project2-*.zip
```

---

## ⏱️ Estimated Time

- Screenshot organization: 5 minutes
- GitHub push: 10 minutes
- GitHub.io verification: 5 minutes
- Create zip files: 5 minutes
- Fill rubric: 15 minutes
- Final check: 5 minutes

**Total: ~45 minutes**

---

## 🚀 Priority Order

1. **High Priority:**
   - Push to GitHub
   - Verify GitHub Actions
   - Capture GitHub Actions screenshot

2. **Medium Priority:**
   - Organize screenshots
   - Create zip files

3. **Low Priority:**
   - Fill out grading rubric
   - Final verification

---

Good luck with your submission! 🎉

