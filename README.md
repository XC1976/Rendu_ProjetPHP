# Rendu et historique du mini projet PHP

## CHAN Kyle BTC 28.1

- master : Latest (Rendu 2 ==> 2025-11-20)
- rendu1 : Snapshot rendu du 2025-11-19
- rendu2 : Snapshot rendu du 2025-11-20

Rough general architecture

```
Root/ (Stores VIEW pages, .php / .html pages that the user actually see)
├── assets/
│   ├── js/
│   └── css/
│       └── style.css (stylesheet shared with every file)        
│           
├── includes/ (All the .php includes)
│   └── head.php (Shared content of <head> tag as include)        
│ 
└── actions/ (Controller PHP files that are never viewved by the user)

This project emulates environment variable in uppercase e.g. $ROOT
```