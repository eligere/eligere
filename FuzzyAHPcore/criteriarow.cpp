
/**********************************************************************************************************
 *  <ELIGERE: a Fuzzy AHP Distributed Software Platform for Group Decision Making in Engineering Design>  *
 *   Copyright (C) 2016  by Mateusz Gospodarczyk and Stanislao Grazioso                                   *
 *  																									  *
 *   ELIGERE is free software: you can redistribute it and/or modify									  *
 *   it under the terms of the GNU General Public License as 											  *
 *   published by the Free Software Foundation, either version 3 of the 								  *
 *   License, or (at your option) any later version.													  *
 *																										  *
 *   This program is distributed in the hope that it will be useful,									  *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of										  *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the										  *
 *   GNU General Public License for more details.														  *
 *																										  *
 *   You should have received a copy of the GNU General Public License									  *
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.								  *
 * 																										  *
 *   Contacts: mateusz.gospodarczyk@uniroma2.it and stanislao.grazioso@unina.it 						  *
 *********************************************************************************************************/

#include <criteriarow.h>
#include <QRadioButton>
#include <QHBoxLayout>
#include <QObject>

CriteriaRow::CriteriaRow(QWidget *parent) : QWidget(parent), m_criteriaGroup(new QButtonGroup())
{
    QHBoxLayout* hlayout = new QHBoxLayout(this);
    this->setLayout(hlayout);

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
