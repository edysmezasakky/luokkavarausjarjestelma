# Luokkavarausjärjestelmä

Rakennetaan selainpohjainen luokkavarausjärjestelmä

Käyttäjän tarinnat

# Requirements

- [Composer](https://getcomposer.org/download/)
- [NodeJS](https://nodejs.org/en/download)

# Pull request Workflow

- Luodaan branch. Source control > ... > Create branch from... esi. minun-branch valitse `main`.
- Muokaa tai lisaa tiedostot ja Commit niiden. Source control > Changes > Kirjoita Message > Commit
- Laheta muutoksia palveluihin. Source control > Sync Data
- Luoda Pull request. Menee https://github.com/edysmezasakky/luokkavarausjarjestelma/pulls ja Create pull request.

# Code formatting VS Code

Install the `Intelephense` by `Ben Mewburn` extension.

# Compile styles

- Compile once `npm run css`
- While developing `npm run watch`


# Get started
Having the proyec folder at `C:\xampp\htdocs\luokkavarausjarjestelma` run the folloing to get it working.
- Download dependices: `compo install`
- Compile theme: `npm run css`


# QA
- `npm` do not work. Follow: 
1. Open PowerShell as Administrator: Search for "PowerShell" in the Start menu, right-click on it, and select "Run as administrator". 
2. Change the Execution Policy: In the PowerShell window, type the following command and press Enter: `Set-ExecutionPolicy RemoteSigned`