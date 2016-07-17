#ifndef UTIL_H
#define UTIL_H
#include <QtSql>

class Util
{
public:
    Util();
    static int connectToDB(QSqlDatabase db);

signals:

public slots:
};

#endif // UTIL_H
