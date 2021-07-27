FROM ecointet/php-nginx:7     

#RUN apt-get update && \
#    apt-get install -y vim curl wget build-essential nginx supervisor gnupg2

#RUN echo "deb http://packages.dotdeb.org jessie all" > /etc/apt/sources.list.d/dotdeb.list && \
#    wget https://www.dotdeb.org/dotdeb.gpg && \
#    apt-key add dotdeb.gpg

#RUN apt-get update && apt-get install -y \
#        libfreetype6-dev \
#        libjpeg62-turbo-dev \
#        libmcrypt-dev \
#    && docker-php-ext-install pdo_mysql mysqli zip

COPY ./default /etc/nginx/sites-enabled
COPY supervisord.conf /etc/

#RUN apt-get update
#RUN apt-get install -y emacs
#RUN apt-get install -y mysql-server
#RUN apt-get install -y apt-transport-https
#RUN apt-get install -y stress

COPY ./10-nginx.conf /etc/collectd/managed_config/
ADD  src/ /usr/data/

ARG GITHUBLOGIN
RUN echo $GITHUBLOGIN > /usr/data/data/githublogin.txt

RUN  chmod -R 777 /usr/data/
EXPOSE 8000

CMD /usr/bin/supervisord -n -c /etc/supervisord.conf && chmod -R 777 /data-ext
