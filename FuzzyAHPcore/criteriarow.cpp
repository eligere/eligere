#include <criteriarow.h>
#include <QRadioButton>
#include <QHBoxLayout>
#include <QObject>

CriteriaRow::CriteriaRow(QWidget *parent) : QWidget(parent), m_criteriaGroup(new QButtonGroup())
{
    QHBoxLayout* hlayout = new QHBoxLayout(this);
    this->setLayout(hlayout);

    // i valori stundart


    QRadioButton* radio1 = new QRadioButton(tr("+++"));

    QRadioButton* radio2 = new QRadioButton(tr("++"));
    QRadioButton* radio3 = new QRadioButton(tr("+"));
    QRadioButton* radio4 = new QRadioButton(tr("="));
    QRadioButton* radio5 = new QRadioButton(tr("-"));
    QRadioButton* radio6 = new QRadioButton(tr("--"));
    QRadioButton* radio7 = new QRadioButton(tr("---"));

    radio4->setChecked(true);


    hlayout->addWidget(radio1);
    hlayout->addWidget(radio2);
    hlayout->addWidget(radio3);
    hlayout->addWidget(radio4);
    hlayout->addWidget(radio5);
    hlayout->addWidget(radio6);
    hlayout->addWidget(radio7);


    m_criteriaGroup->addButton(radio1);
    m_criteriaGroup->addButton(radio2);
    m_criteriaGroup->addButton(radio3);
    m_criteriaGroup->addButton(radio4);
    m_criteriaGroup->addButton(radio5);
    m_criteriaGroup->addButton(radio6);
    m_criteriaGroup->addButton(radio7);

}

CriteriaRow::~CriteriaRow()
{
    delete m_criteriaGroup;
}
