#This base image already adds the composer dependencies for firestore
FROM fjunior87/phpfpm7-google-firestore:0.0.1

COPY ./default /etc/nginx/sites-enabled
COPY supervisord.conf /etc/

COPY ./10-nginx.conf /etc/collectd/managed_config/
ADD  src/ /usr/data/

EXPOSE 8000

CMD /usr/bin/supervisord -n -c /etc/supervisord.conf 

