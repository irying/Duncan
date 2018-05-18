FROM registry.cn-hangzhou.aliyuncs.com/mooyoo/php70-openresty:latest

MAINTAINER beckjiang <beckjiang@mooyoo.com.cn>

# 复制配置文件
COPY docker/conf/nginx /usr/local/openresty/nginx/conf
COPY docker/conf/php/conf.d /usr/local/etc/php/conf.d
COPY docker/conf/php-fpm /usr/local/etc/

# 安装thrift
RUN apt update && \
        apt install -y libboost-dev libboost-test-dev libboost-program-options-dev libevent-dev \
        automake libtool flex bison pkg-config g++ libssl-dev git build-essential libcurl4-gnutls-dev && \
        git clone https://git-wip-us.apache.org/repos/asf/thrift.git && \
        cd thrift && \
        ./bootstrap.sh && \
 		./configure && \
        make && make install   
# 安装yar
RUN /usr/local/bin/pecl install msgpack && \
    echo "extension=msgpack.so\n" >> /usr/local/etc/php/conf.d/yar.ini && \
    echo "yes" | /usr/local/bin/pecl install yar && \
    echo "extension=yar.so\n" >> /usr/local/etc/php/conf.d/yar.ini

# 安装composer
RUN cd ~ && mkdir bin -p && \
	curl -sS https://getcomposer.org/installer | php -- --install-dir=bin --filename=composer

# 复制代码文件
COPY src /data/www/meijiabang.cn

# 执行composer
RUN cd /data/www/meijiabang.cn/thrift/php && \
    rm -r vendor && \
	~/bin/composer update

# 安装pcntl
RUN docker-php-ext-install pcntl

# 安装java编译环境
RUN apt install -y software-properties-common && \
    add-apt-repository ppa:webupd8team/java -y && \
    apt update && \
    echo oracle-java8-installer shared/accepted-oracle-license-v1-1 select true | /usr/bin/debconf-set-selections && \
    apt-get --yes --force-yes install oracle-java8-installer

# 安装maven
RUN wget http://apache-mirror.rbc.ru/pub/apache/maven/maven-3/3.3.9/binaries/apache-maven-3.3.9-bin.tar.gz
RUN tar xzvf apache-maven-3.3.9-bin.tar.gz
RUN cp -R apache-maven-3.3.9 /usr/local/bin
RUN export JAVA_HOME=/usr/lib/jvm/java-8-oracle/jre
RUN export PATH=apache-maven-3.3.9/bin:$PATH
RUN export PATH=/usr/local/bin/apache-maven-3.3.9/bin:$PATH
RUN ln -s /usr/local/bin/apache-maven-3.3.9/bin/mvn /usr/local/bin/mvn

# 安装swoole
RUN /usr/local/bin/pecl install swoole && \
    echo "extension=swoole.so\n" >> /usr/local/etc/php/conf.d/swoole.ini