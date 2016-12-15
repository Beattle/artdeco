function doToggleHelpfulMinusRating(id)
{
	el=BX.findChildren(document.body,{
		className: 'webavk_ibcomments_helpul_rating_hide_'+id
	},true);
	for (i=0;i<el.length;i++)
	{
		if (el[i].style.display == 'none')
		{
			el[i].style.display = 'table-row';
		} else {
			el[i].style.display = 'none';
		}
	}
}
		
function doSetCommentVote(typeVote, iVote)
{
	BX.findChildren(document.getElementById("webavk_ibcomments_add_form"), {
		attribute:{
			name: 'COMMENT['+typeVote+']'
		}
	}, true)[0].setAttribute("value",iVote);		
}
function doCommentVoteMouseOver(typeVote, iVote)
{
	var nodes = BX.findChildren(document.getElementById("webavk_ibcomments_add_form"), {
		className: 'webavk_ibcomments_star', 
		attribute:{
			rel: typeVote
		}
	}, true);
	for (var i = 1; i <= nodes.length; i++) {
		if (i<=iVote)
		{
			BX.addClass(nodes[i-1], "webavk_ibcomments_star_active");
		} else {
			BX.removeClass(nodes[i-1], "webavk_ibcomments_star_active");
		}
	}
}
function doCommentVoteMouseOut(typeVote)
{
	//iVote
	var nodesInput = BX.findChildren(document.getElementById("webavk_ibcomments_add_form"), {
		attribute:{
			name: 'COMMENT['+typeVote+']'
		}
	}, true);
	if (nodesInput.length==1)
	{
		iVote=parseInt(nodesInput[0].getAttribute("value"));
	} else {
		iVote=0;
	}
	var nodes = BX.findChildren(document.getElementById("webavk_ibcomments_add_form"), {
		className: 'webavk_ibcomments_star', 
		attribute:{
			rel: typeVote
		}
	}, true);
	for (var i = 1; i <= nodes.length; i++) {
		if (i<=iVote)
		{
			BX.addClass(nodes[i-1], "webavk_ibcomments_star_active");
		} else {
			BX.removeClass(nodes[i-1], "webavk_ibcomments_star_active");
		}
	}
}
function doToggleShowCommentForm(el)
{
	a=BX.findParent(el, {
		className: 'webavk_ibcomments_add_area'
	}, 5);
	b=BX.findChildren(a,{
		className: 'webavk_ibcomments_add_form'
	},true);
	BX.toggle(b[0]);
	return false;
}

function doShowAdminAnswerForm(itemId)
{
	BX.findChildren(document.body,{
		className: 'webavk_ibcomments_admin_answer_'+itemId
	},true)[0].appendChild(BX.findChildren(document.body,{
		className: 'webavk_ibcomments_answer_area'
	},true)[0]);
	BX.show(BX.findChildren(document.body,{
		className: 'webavk_ibcomments_answer_area'
	},true)[0]);
	BX.findChildren(BX.findChildren(document.body,{
		className: 'webavk_ibcomments_answer_area'
	},true)[0],{
		attribute:{
			name:'ANSWER[COMMENT_ID]'
		}
	},true)[0].setAttribute("value", itemId);
	if (BX.findChildren(document.body,{
		attribute:{
			name:'adminAnswer'+itemId
		}
	},true).length>0)
	{
		BX.findChildren(BX.findChildren(document.body,{
			className: 'webavk_ibcomments_answer_area'
		},true)[0],{
			attribute:{
				name:'ANSWER[TEXT]'
			}
		},true)[0].innerHTML=BX.findChildren(document.body,{
			attribute:{
				name:'adminAnswer'+itemId
			}
		},true)[0].getAttribute("value");
	}
}