FROM ubuntu:23.04 as tailwindcss_admin

RUN apt-get -y update
RUN apt-get -y install curl

RUN curl -sLO https://github.com/tailwindlabs/tailwindcss/releases/latest/download/tailwindcss-linux-x64
RUN chmod +x tailwindcss-linux-x64
RUN mv tailwindcss-linux-x64 /bin/tailwindcss

CMD /bin/tailwindcss \
-i admin/assets/css/tailwind.css \
-c admin/tailwind.config.js \
-o admin/tailwind.output.css \
--watch
