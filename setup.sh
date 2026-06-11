#!/bin/bash
set -e

echo "=== Tark Käsi OÜ WordPress setup ==="

# Wait for DB: use php to test connection directly (avoids mariadb SSL issue)
echo "Waiting for database..."
until php -r "
  \$h = getenv('WORDPRESS_DB_HOST') ?: 'db';
  \$u = getenv('WORDPRESS_DB_USER') ?: 'wordpress';
  \$p = getenv('WORDPRESS_DB_PASSWORD') ?: 'wordpress';
  \$d = getenv('WORDPRESS_DB_NAME') ?: 'wordpress';
  \$c = @mysqli_connect(\$h, \$u, \$p, \$d);
  if (\$c) { echo 'ok'; exit(0); } exit(1);
" 2>/dev/null; do
  sleep 3
done
echo "Database ready."

# Install WordPress if not already installed
if ! wp core is-installed 2>/dev/null; then
  wp core install \
    --url="http://localhost:8080" \
    --title="Tark Käsi OÜ" \
    --admin_user="admin" \
    --admin_password="admin123" \
    --admin_email="info@tarkkasi.ee" \
    --skip-email
  echo "WordPress installed."
else
  echo "WordPress already installed, skipping."
fi

# Site description
wp option update blogdescription "Käsitööpagari koduleht"

# Install and activate ACF plugin
if ! wp plugin is-active advanced-custom-fields 2>/dev/null; then
  wp plugin install advanced-custom-fields --activate
  echo "ACF plugin installed and activated."
fi

# Activate our custom theme
wp theme activate tark-kasi
echo "Theme activated."

# Activate our CPT plugin
wp plugin activate tark-kasi-cpt
echo "CPT plugin activated."

# Remove default post and sample page
wp post delete 1 --force 2>/dev/null || true
wp post delete 2 --force 2>/dev/null || true

# Create pages
ESILEHT_ID=$(wp post create \
  --post_type=page \
  --post_title="Avaleht" \
  --post_name="avaleht" \
  --post_status=publish \
  --post_content="" \
  --porcelain)

UUDISED_ID=$(wp post create \
  --post_type=page \
  --post_title="Uudised" \
  --post_name="uudised" \
  --post_status=publish \
  --post_content="" \
  --porcelain)

KONTAKT_ID=$(wp post create \
  --post_type=page \
  --post_title="Kontakt" \
  --post_name="kontakt" \
  --post_status=publish \
  --post_content="" \
  --porcelain)

echo "Pages created: Avaleht=$ESILEHT_ID, Uudised=$UUDISED_ID, Kontakt=$KONTAKT_ID"

# Set front page and posts page
wp option update show_on_front "page"
wp option update page_on_front "$ESILEHT_ID"
wp option update page_for_posts "$UUDISED_ID"

# Create navigation menu
wp menu create "Peamine navigatsioon"
MENU_ID=$(wp menu list --field=term_id | head -1)

wp menu item add-post "$MENU_ID" "$ESILEHT_ID" --title="Avaleht"
wp menu item add-post "$MENU_ID" "$UUDISED_ID" --title="Uudised"
wp menu item add-post "$MENU_ID" "$KONTAKT_ID" --title="Kontakt"
wp menu location assign "$MENU_ID" primary

echo "Navigation menu set up."

# Set permalink structure
wp rewrite structure "/%postname%/"
wp rewrite flush

# Add sample news posts
POST1=$(wp post create \
  --post_type=post \
  --post_title="Avame laupäeval uue müügipunkti Ülemiste Citys" \
  --post_status=publish \
  --post_content="<p>Oleme põnevil teatada, et avame laupäeval uue müügipunkti Ülemiste Citys. Teid ootavad meie maitsvad käsitööleivad ja -saiakesed iga päev kella 8–20.</p><p>Esimesel nädalal saavad kõik külastajad 10% allahindlust kõigile toodetele. Ootame teid külla!</p>" \
  --porcelain)

POST2=$(wp post create \
  --post_type=post \
  --post_title="Uus hooajaline toode: Jõuluküpsis traditsioonilise retsepti järgi" \
  --post_status=publish \
  --post_content="<p>Lisasime oma valikule uued jõuluküpsised, mis on valmistatud traditsioonilise retsepti järgi. Küpsised sisaldavad ingverit, kaneeli ja apelsinikoort.</p><p>Küpsised on saadaval meie poes alates 1. detsembrist piiratud koguses – kiirusta järele!</p>" \
  --porcelain)

POST3=$(wp post create \
  --post_type=post \
  --post_title="Tark Käsi OÜ tähistab viiendat tegevusaastat" \
  --post_status=publish \
  --post_content="<p>Sel aastal tähistab Tark Käsi OÜ oma viiendat tegevusaastat. Viie aasta jooksul oleme kasvanud väikesest kodusest pagariärist üheks Tallinna armastatuimaks käsitööpagariks.</p><p>Täname kõiki oma kliente ja koostööpartnereid toetuse eest. Teie usaldus annab meile jõudu edasi teha seda, mida armastame – küpsetada maitsvat käsitöölleiba.</p>" \
  --porcelain)

echo "News posts created: $POST1, $POST2, $POST3"

# Add sample products (CPT: toode)
TOODE1=$(wp post create \
  --post_type=toode \
  --post_title="Hapuleib" \
  --post_status=publish \
  --post_content="<p>Meie klassikaline hapuleib, mis on küpsetatud traditsioonilise haputainaga üle 24 tunni. Tihe, maitsev ja pikaealine – sobib igaks päevaks.</p>" \
  --porcelain)
wp post meta update "$TOODE1" hind "4.50€"
wp post meta update "$TOODE1" koostisosad "Rukkijahu, nisujahu, haputainas, sool, vesi"
wp post meta update "$TOODE1" valmistamisaeg "26 tundi"

TOODE2=$(wp post create \
  --post_type=toode \
  --post_title="Kaneelisaiak" \
  --post_status=publish \
  --post_content="<p>Pehme ja maitsev kaneelisaiak, mis on valmistatud värskelt igal hommikul. Täidis on valmistatud ehtsa kaneeli ja pruuni suhkruga.</p>" \
  --porcelain)
wp post meta update "$TOODE2" hind "2.20€"
wp post meta update "$TOODE2" koostisosad "Nisujahu, piim, muna, või, kaneel, pruun suhkur, pärm"
wp post meta update "$TOODE2" valmistamisaeg "3 tundi"

TOODE3=$(wp post create \
  --post_type=toode \
  --post_title="Mooniseemnekook" \
  --post_status=publish \
  --post_content="<p>Mahlane mooniseemnekook, mida küpsetame traditsioonilise retsepti järgi. Õrn ja maitsev nii kohvikõrvaseks kui ka pidulauaks.</p>" \
  --porcelain)
wp post meta update "$TOODE3" hind "18.00€"
wp post meta update "$TOODE3" koostisosad "Nisujahu, munad, suhkur, või, mooniseemned, piim, vanill"
wp post meta update "$TOODE3" valmistamisaeg "2 tundi"

echo "Products created: $TOODE1, $TOODE2, $TOODE3"

echo ""
echo "=== Setup complete! ==="
echo "Site:  http://localhost:8080"
echo "Admin: http://localhost:8080/wp-admin"
echo "User:  admin / admin123"
