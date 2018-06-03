# Test technique pour développeur back-end

## Objectifs : 
- Créer une page de contact avec des champs dynamiques
```
1. Le formulaire doit enregister les demandes de contact dans une table appellée 'contacts'
2. Au choix du sujet, les champs du formulaire sont mis à jour ( sans refresh de la page )
```

> Voici les différents champs du formulaire de contact ( ceux-ci changent en fonction du sujet sélectionné )
- Champs communs :
    - Sujet [ Choix parmis ("Demande de contact", "Signaler un problème", "Demande d'inscription") ] *requis
    
- Champs quand "Demande de contact" est sélectionné :
    - Email [ email ] *requis
    - Nom [ Texte court libre ] *requis
    - Message [ Texte long libre ] *requis
    
- Champs quand "Signaler un problème" est sélectionné :
    - Raison [ Choix parmis ("Une erreur est survenue", "J'ai besoin d'aide", "Autre") ] *requis
    - Details [ Texte libre ] *requis
    
- Champs quand "Demande d'inscription" est sélectionné :
    - Email [ email ] *requis
    - Nom [ Texte court libre ] *requis
    - Numéro de téléphone *optionnel
    - Adresse *required
    - Message [ Texte long libre ] *optionnel