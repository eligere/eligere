/********************************************************************************
** Form generated from reading UI file 'mainwindow.ui'
**
** Created by: Qt User Interface Compiler version 5.6.0
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_MAINWINDOW_H
#define UI_MAINWINDOW_H

#include <QtCore/QVariant>
#include <QtWidgets/QAction>
#include <QtWidgets/QApplication>
#include <QtWidgets/QButtonGroup>
#include <QtWidgets/QComboBox>
#include <QtWidgets/QGridLayout>
#include <QtWidgets/QHBoxLayout>
#include <QtWidgets/QHeaderView>
#include <QtWidgets/QLabel>
#include <QtWidgets/QLineEdit>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenu>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QScrollArea>
#include <QtWidgets/QSpacerItem>
#include <QtWidgets/QSpinBox>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QTextEdit>
#include <QtWidgets/QToolBar>
#include <QtWidgets/QVBoxLayout>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_MainWindow
{
public:
    QWidget *centralWidget;
    QVBoxLayout *verticalLayout_2;
    QHBoxLayout *horizontalLayout;
    QLabel *label;
    QComboBox *questionnarie;
    QPushButton *questOK;
    QGridLayout *gridLayout;
    QPushButton *pushButton_Ok;
    QSpinBox *spinBox_Criteria;
    QSpinBox *spinBox_Surveyed;
    QLabel *label_Alternatives;
    QLabel *label_Surveyed;
    QSpinBox *spinBox_Alternatives;
    QLabel *label_Criteria;
    QPushButton *pushButton_section1;
    QPushButton *pushButton_section2;
    QLineEdit *lineEdit;
    QScrollArea *scrollArea;
    QWidget *scrollAreaWidgetContents_2;
    QVBoxLayout *verticalLayout;
    QVBoxLayout *verticalLayout_3;
    QLabel *label_section1_surveyedNumber;
    QSpinBox *spinBox_section1_surveyedNumber;
    QPushButton *pushButton_section1_saveTheResults;
    QPushButton *pushButton_section1_toNextSurveyed;
    QLabel *label_section1_endSurveyed;
    QSpacerItem *verticalSpacer_4;
    QLabel *label_section2_surveyedNumber;
    QSpinBox *spinBox_section2_surveyedNumber;
    QLabel *label_section2_criterionNumber;
    QSpinBox *spinBox_section2_criterionNumber;
    QPushButton *pushButton_section2_saveTheResults;
    QPushButton *pushButton_section2_toNextCriterion;
    QLabel *label_section2_endCriterion;
    QPushButton *pushButton_section2_toNextSurveyed;
    QLabel *label_section2_endSurveyed;
    QSpacerItem *verticalSpacer_3;
    QPushButton *pushButton_section1_calculations;
    QPushButton *pushButton_section2_calculations;
    QHBoxLayout *horizontalLayout_2;
    QTextEdit *fuzzyResultsOnscreen;
    QMenuBar *menuBar;
    QMenu *menuFuzzy_AHP;
    QToolBar *mainToolBar;
    QStatusBar *statusBar;
    QToolBar *toolBar;

    void setupUi(QMainWindow *MainWindow)
    {
        if (MainWindow->objectName().isEmpty())
            MainWindow->setObjectName(QStringLiteral("MainWindow"));
        MainWindow->resize(852, 954);
        MainWindow->setMaximumSize(QSize(1677721, 1677721));
        centralWidget = new QWidget(MainWindow);
        centralWidget->setObjectName(QStringLiteral("centralWidget"));
        verticalLayout_2 = new QVBoxLayout(centralWidget);
        verticalLayout_2->setSpacing(6);
        verticalLayout_2->setContentsMargins(11, 11, 11, 11);
        verticalLayout_2->setObjectName(QStringLiteral("verticalLayout_2"));
        horizontalLayout = new QHBoxLayout();
        horizontalLayout->setSpacing(6);
        horizontalLayout->setObjectName(QStringLiteral("horizontalLayout"));
        label = new QLabel(centralWidget);
        label->setObjectName(QStringLiteral("label"));
        label->setMaximumSize(QSize(100, 16777215));

        horizontalLayout->addWidget(label);

        questionnarie = new QComboBox(centralWidget);
        questionnarie->setObjectName(QStringLiteral("questionnarie"));
        questionnarie->setMaximumSize(QSize(335, 100));
        questionnarie->setCursor(QCursor(Qt::IBeamCursor));

        horizontalLayout->addWidget(questionnarie);

        questOK = new QPushButton(centralWidget);
        questOK->setObjectName(QStringLiteral("questOK"));
        questOK->setMaximumSize(QSize(100, 45));

        horizontalLayout->addWidget(questOK);


        verticalLayout_2->addLayout(horizontalLayout);

        gridLayout = new QGridLayout();
        gridLayout->setSpacing(6);
        gridLayout->setObjectName(QStringLiteral("gridLayout"));
        pushButton_Ok = new QPushButton(centralWidget);
        pushButton_Ok->setObjectName(QStringLiteral("pushButton_Ok"));

        gridLayout->addWidget(pushButton_Ok, 0, 6, 1, 1);

        spinBox_Criteria = new QSpinBox(centralWidget);
        spinBox_Criteria->setObjectName(QStringLiteral("spinBox_Criteria"));
        spinBox_Criteria->setMinimum(1);
        spinBox_Criteria->setMaximum(10);

        gridLayout->addWidget(spinBox_Criteria, 0, 1, 1, 1);

        spinBox_Surveyed = new QSpinBox(centralWidget);
        spinBox_Surveyed->setObjectName(QStringLiteral("spinBox_Surveyed"));
        spinBox_Surveyed->setMinimum(1);
        spinBox_Surveyed->setMaximum(10);

        gridLayout->addWidget(spinBox_Surveyed, 0, 5, 1, 1);

        label_Alternatives = new QLabel(centralWidget);
        label_Alternatives->setObjectName(QStringLiteral("label_Alternatives"));

        gridLayout->addWidget(label_Alternatives, 0, 2, 1, 1);

        label_Surveyed = new QLabel(centralWidget);
        label_Surveyed->setObjectName(QStringLiteral("label_Surveyed"));

        gridLayout->addWidget(label_Surveyed, 0, 4, 1, 1);

        spinBox_Alternatives = new QSpinBox(centralWidget);
        spinBox_Alternatives->setObjectName(QStringLiteral("spinBox_Alternatives"));
        spinBox_Alternatives->setMinimum(1);
        spinBox_Alternatives->setMaximum(10);

        gridLayout->addWidget(spinBox_Alternatives, 0, 3, 1, 1);

        label_Criteria = new QLabel(centralWidget);
        label_Criteria->setObjectName(QStringLiteral("label_Criteria"));

        gridLayout->addWidget(label_Criteria, 0, 0, 1, 1);


        verticalLayout_2->addLayout(gridLayout);

        pushButton_section1 = new QPushButton(centralWidget);
        pushButton_section1->setObjectName(QStringLiteral("pushButton_section1"));

        verticalLayout_2->addWidget(pushButton_section1);

        pushButton_section2 = new QPushButton(centralWidget);
        pushButton_section2->setObjectName(QStringLiteral("pushButton_section2"));

        verticalLayout_2->addWidget(pushButton_section2);

        lineEdit = new QLineEdit(centralWidget);
        lineEdit->setObjectName(QStringLiteral("lineEdit"));

        verticalLayout_2->addWidget(lineEdit);

        scrollArea = new QScrollArea(centralWidget);
        scrollArea->setObjectName(QStringLiteral("scrollArea"));
        scrollArea->setWidgetResizable(true);
        scrollAreaWidgetContents_2 = new QWidget();
        scrollAreaWidgetContents_2->setObjectName(QStringLiteral("scrollAreaWidgetContents_2"));
        scrollAreaWidgetContents_2->setGeometry(QRect(0, 0, 832, 69));
        scrollArea->setWidget(scrollAreaWidgetContents_2);

        verticalLayout_2->addWidget(scrollArea);

        verticalLayout = new QVBoxLayout();
        verticalLayout->setSpacing(0);
        verticalLayout->setObjectName(QStringLiteral("verticalLayout"));
        verticalLayout->setSizeConstraint(QLayout::SetNoConstraint);
        verticalLayout->setContentsMargins(0, 0, 0, 0);

        verticalLayout_2->addLayout(verticalLayout);

        verticalLayout_3 = new QVBoxLayout();
        verticalLayout_3->setSpacing(6);
        verticalLayout_3->setObjectName(QStringLiteral("verticalLayout_3"));
        label_section1_surveyedNumber = new QLabel(centralWidget);
        label_section1_surveyedNumber->setObjectName(QStringLiteral("label_section1_surveyedNumber"));

        verticalLayout_3->addWidget(label_section1_surveyedNumber);

        spinBox_section1_surveyedNumber = new QSpinBox(centralWidget);
        spinBox_section1_surveyedNumber->setObjectName(QStringLiteral("spinBox_section1_surveyedNumber"));
        spinBox_section1_surveyedNumber->setMinimum(1);
        spinBox_section1_surveyedNumber->setMaximum(10);
        spinBox_section1_surveyedNumber->setSingleStep(1);

        verticalLayout_3->addWidget(spinBox_section1_surveyedNumber);

        pushButton_section1_saveTheResults = new QPushButton(centralWidget);
        pushButton_section1_saveTheResults->setObjectName(QStringLiteral("pushButton_section1_saveTheResults"));

        verticalLayout_3->addWidget(pushButton_section1_saveTheResults);

        pushButton_section1_toNextSurveyed = new QPushButton(centralWidget);
        pushButton_section1_toNextSurveyed->setObjectName(QStringLiteral("pushButton_section1_toNextSurveyed"));

        verticalLayout_3->addWidget(pushButton_section1_toNextSurveyed);

        label_section1_endSurveyed = new QLabel(centralWidget);
        label_section1_endSurveyed->setObjectName(QStringLiteral("label_section1_endSurveyed"));

        verticalLayout_3->addWidget(label_section1_endSurveyed);

        verticalSpacer_4 = new QSpacerItem(829, 30, QSizePolicy::Minimum, QSizePolicy::Expanding);

        verticalLayout_3->addItem(verticalSpacer_4);

        label_section2_surveyedNumber = new QLabel(centralWidget);
        label_section2_surveyedNumber->setObjectName(QStringLiteral("label_section2_surveyedNumber"));

        verticalLayout_3->addWidget(label_section2_surveyedNumber);

        spinBox_section2_surveyedNumber = new QSpinBox(centralWidget);
        spinBox_section2_surveyedNumber->setObjectName(QStringLiteral("spinBox_section2_surveyedNumber"));
        spinBox_section2_surveyedNumber->setMinimum(1);
        spinBox_section2_surveyedNumber->setMaximum(10);

        verticalLayout_3->addWidget(spinBox_section2_surveyedNumber);

        label_section2_criterionNumber = new QLabel(centralWidget);
        label_section2_criterionNumber->setObjectName(QStringLiteral("label_section2_criterionNumber"));

        verticalLayout_3->addWidget(label_section2_criterionNumber);

        spinBox_section2_criterionNumber = new QSpinBox(centralWidget);
        spinBox_section2_criterionNumber->setObjectName(QStringLiteral("spinBox_section2_criterionNumber"));
        spinBox_section2_criterionNumber->setMinimum(1);
        spinBox_section2_criterionNumber->setMaximum(10);

        verticalLayout_3->addWidget(spinBox_section2_criterionNumber);

        pushButton_section2_saveTheResults = new QPushButton(centralWidget);
        pushButton_section2_saveTheResults->setObjectName(QStringLiteral("pushButton_section2_saveTheResults"));

        verticalLayout_3->addWidget(pushButton_section2_saveTheResults);

        pushButton_section2_toNextCriterion = new QPushButton(centralWidget);
        pushButton_section2_toNextCriterion->setObjectName(QStringLiteral("pushButton_section2_toNextCriterion"));

        verticalLayout_3->addWidget(pushButton_section2_toNextCriterion);

        label_section2_endCriterion = new QLabel(centralWidget);
        label_section2_endCriterion->setObjectName(QStringLiteral("label_section2_endCriterion"));

        verticalLayout_3->addWidget(label_section2_endCriterion);

        pushButton_section2_toNextSurveyed = new QPushButton(centralWidget);
        pushButton_section2_toNextSurveyed->setObjectName(QStringLiteral("pushButton_section2_toNextSurveyed"));

        verticalLayout_3->addWidget(pushButton_section2_toNextSurveyed);

        label_section2_endSurveyed = new QLabel(centralWidget);
        label_section2_endSurveyed->setObjectName(QStringLiteral("label_section2_endSurveyed"));

        verticalLayout_3->addWidget(label_section2_endSurveyed);

        verticalSpacer_3 = new QSpacerItem(20, 40, QSizePolicy::Minimum, QSizePolicy::Expanding);

        verticalLayout_3->addItem(verticalSpacer_3);

        pushButton_section1_calculations = new QPushButton(centralWidget);
        pushButton_section1_calculations->setObjectName(QStringLiteral("pushButton_section1_calculations"));

        verticalLayout_3->addWidget(pushButton_section1_calculations);

        pushButton_section2_calculations = new QPushButton(centralWidget);
        pushButton_section2_calculations->setObjectName(QStringLiteral("pushButton_section2_calculations"));

        verticalLayout_3->addWidget(pushButton_section2_calculations);


        verticalLayout_2->addLayout(verticalLayout_3);

        horizontalLayout_2 = new QHBoxLayout();
        horizontalLayout_2->setSpacing(6);
        horizontalLayout_2->setObjectName(QStringLiteral("horizontalLayout_2"));

        verticalLayout_2->addLayout(horizontalLayout_2);

        fuzzyResultsOnscreen = new QTextEdit(centralWidget);
        fuzzyResultsOnscreen->setObjectName(QStringLiteral("fuzzyResultsOnscreen"));

        verticalLayout_2->addWidget(fuzzyResultsOnscreen);

        MainWindow->setCentralWidget(centralWidget);
        menuBar = new QMenuBar(MainWindow);
        menuBar->setObjectName(QStringLiteral("menuBar"));
        menuBar->setGeometry(QRect(0, 0, 852, 21));
        menuFuzzy_AHP = new QMenu(menuBar);
        menuFuzzy_AHP->setObjectName(QStringLiteral("menuFuzzy_AHP"));
        MainWindow->setMenuBar(menuBar);
        mainToolBar = new QToolBar(MainWindow);
        mainToolBar->setObjectName(QStringLiteral("mainToolBar"));
        MainWindow->addToolBar(Qt::TopToolBarArea, mainToolBar);
        statusBar = new QStatusBar(MainWindow);
        statusBar->setObjectName(QStringLiteral("statusBar"));
        MainWindow->setStatusBar(statusBar);
        toolBar = new QToolBar(MainWindow);
        toolBar->setObjectName(QStringLiteral("toolBar"));
        MainWindow->addToolBar(Qt::TopToolBarArea, toolBar);

        menuBar->addAction(menuFuzzy_AHP->menuAction());

        retranslateUi(MainWindow);

        QMetaObject::connectSlotsByName(MainWindow);
    } // setupUi

    void retranslateUi(QMainWindow *MainWindow)
    {
        MainWindow->setWindowTitle(QApplication::translate("MainWindow", "MainWindow", 0));
        label->setText(QApplication::translate("MainWindow", "questionnarie", 0));
        questOK->setText(QApplication::translate("MainWindow", "Ok", 0));
        pushButton_Ok->setText(QApplication::translate("MainWindow", "Ok", 0));
        label_Alternatives->setText(QApplication::translate("MainWindow", "Alternatives: ", 0));
        label_Surveyed->setText(QApplication::translate("MainWindow", "Surveyed:", 0));
        label_Criteria->setText(QApplication::translate("MainWindow", "Criteria:", 0));
        pushButton_section1->setText(QApplication::translate("MainWindow", "SECTION 1: 'Preferences'", 0));
        pushButton_section2->setText(QApplication::translate("MainWindow", "SECTION 2: 'Suitability'", 0));
        label_section1_surveyedNumber->setText(QApplication::translate("MainWindow", "Surveyed number:", 0));
        pushButton_section1_saveTheResults->setText(QApplication::translate("MainWindow", "SECTION 1: Save The Results", 0));
        pushButton_section1_toNextSurveyed->setText(QApplication::translate("MainWindow", "SECTION 1: Go To Next Surveyed", 0));
        label_section1_endSurveyed->setText(QApplication::translate("MainWindow", "[SECTION 1] Save The Results for the last surveyed. Then, push on 'SECTION 1: Do Calculation' to do calculus", 0));
        label_section2_surveyedNumber->setText(QApplication::translate("MainWindow", "Surveyed number:", 0));
        label_section2_criterionNumber->setText(QApplication::translate("MainWindow", "Criterion number:", 0));
        pushButton_section2_saveTheResults->setText(QApplication::translate("MainWindow", "SECTION 2: Save The Results", 0));
        pushButton_section2_toNextCriterion->setText(QApplication::translate("MainWindow", "SECTION 2: Go To Next Criterion", 0));
        label_section2_endCriterion->setText(QApplication::translate("MainWindow", "[SECTION 2] Save The Results for the last criterion. Then, push on 'SECTION 2: Go To Next Surveyed' ", 0));
        pushButton_section2_toNextSurveyed->setText(QApplication::translate("MainWindow", "SECTION 2: Go To Next Surveyed", 0));
        label_section2_endSurveyed->setText(QApplication::translate("MainWindow", "[SECTION 2] Save The Results for the last surveyed. Then, push on 'SECTION 2: Do Calculation' to do calculus", 0));
        pushButton_section1_calculations->setText(QApplication::translate("MainWindow", "SECTION 1: Do Calculations", 0));
        pushButton_section2_calculations->setText(QApplication::translate("MainWindow", "SECTION 2: Do Calculations", 0));
        menuFuzzy_AHP->setTitle(QApplication::translate("MainWindow", "Fuzzy AHP", 0));
        toolBar->setWindowTitle(QApplication::translate("MainWindow", "toolBar", 0));
    } // retranslateUi

};

namespace Ui {
    class MainWindow: public Ui_MainWindow {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_MAINWINDOW_H
