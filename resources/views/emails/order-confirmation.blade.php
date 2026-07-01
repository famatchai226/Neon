<x-mail::message>
# Merci pour votre achat !

Bonjour **{{ $order->user->name }}**,

Nous vous confirmons votre achat sur **Neon**.

## Détails de la commande

- **Produit :** {{ $order->product->name }}
- **Montant :** {{ number_format($order->amount, 0, ',', ' ') }} FCFA
- **Date :** {{ $order->created_at->format('d/m/Y à H:i') }}

## Téléchargement

Votre fichier est prêt à être téléchargé. Le lien ci-dessous est valable **24 heures**.

<x-mail::button :url="$downloadUrl">
Télécharger mon fichier
</x-mail::button>

Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :
{{ $downloadUrl }}

Merci de votre confiance !

Cordialement,<br>
L'équipe **Neon**
</x-mail::message>
