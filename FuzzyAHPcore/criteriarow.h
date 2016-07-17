#ifndef CRITERIAROW_H
#define CRITERIAROW_H

#include <QButtonGroup>
#include <QWidget>

class CriteriaRow : public QWidget
{
    Q_OBJECT
public:
    CriteriaRow(QWidget *parent = 0);
    ~CriteriaRow();

    QButtonGroup* m_criteriaGroup;
};

#endif // CRITERIAROW
